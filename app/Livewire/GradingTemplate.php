<?php

namespace App\Livewire;

use App\Models\GradingForm;
use App\Models\GradingResult;
use App\Models\GradingResultDraft;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GradingTemplate extends Component
{
    public $form = [];
    public $teacherIds = [3,4];
    public $gradingFormId;
    public $studentId = 4;

    public function mount($gradingFormId)
    {
        $this->gradingFormId = $gradingFormId;

        $gradingForm = GradingForm::with(['tables.criteriaRows', 'tables.knockoutcriteria', 'tables.pointRanges'])
            ->find($this->gradingFormId);

        if ($gradingForm) {
            $this->form = $gradingForm->toArray();
        }

        if (in_array(Auth::id(), $this->teacherIds)) {
            $draft = $this->getSharedDraft();

            if ($draft) {
                $this->form = $draft->draft_data;
            }
        }
    }

    public function setPoints($tableIndex, $rowIndex, $points)
    {
        if (!in_array(Auth::id(), $this->teacherIds)) {
            session()->flash('error', 'U bent niet gemachtigd om dit formulier te bewerken.');
            return;
        }

        if (isset($this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex])) {
            $this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex]['points'] = $points;
            $this->saveDraft();
        }
    }

    public function getTotalPoints($tableIndex)
    {
        return collect($this->form['tables'][$tableIndex]['criteria_rows'])->sum('points');
    }

    public function getGrandTotalPoints()
    {
        $total = 0;
        foreach ($this->form['tables'] as $table) {
            if (isset($table['criteria_rows']) && is_array($table['criteria_rows'])) {
                foreach ($table['criteria_rows'] as $row) {
                    $total += isset($row['points']) ? (float)$row['points'] : 0;
                }
            }
        }
        return $total;
    }

    public function getMaxObtainablePointsProperty()
    {
        return collect($this->form['tables'])->sum('max_points');
    }

    public function getMinObtainablePointsProperty()
    {
        return collect($this->form['tables'])->sum('min_points');
    }

    public function pollDrafts()
    {
        if (!in_array(Auth::id(), $this->teacherIds)) {
            return;
        }

        $draft = $this->getSharedDraft();

        if ($draft) {
            $this->form = $draft->draft_data;
        }
    }
    public function updated($propertyName)
    {

        if (str_starts_with($propertyName, 'form.') && in_array(Auth::id(), $this->teacherIds)) {
            if (str_contains($propertyName, '.points')) {
                return;
            }

            $this->saveDraft();
        }
    }

    public function saveDraft()
    {
        if (!in_array(Auth::id(), $this->teacherIds)) {
            session()->flash('error', 'U bent niet gemachtigd om dit formulier op te slaan.');
            return;
        }

        try {
            $draft = GradingResultDraft::firstOrCreate(
                [
                    'grading_form_id' => $this->gradingFormId,
                    'student_id' => $this->studentId,
                ],
                [
                    'draft_data' => $this->form,
                ]
            );

            $draft->update(['draft_data' => $this->form]);

            $draft->teachers()->sync($this->teacherIds);

        } catch (\Exception $e) {
            \Log::error('Failed to save draft', [
                'error' => $e->getMessage(),
                'grading_form_id' => $this->gradingFormId,
                'student_id' => $this->studentId,
                'current_user' => Auth::id()
            ]);

            session()->flash('error', 'Fout bij opslaan: ' . $e->getMessage());
        }
    }

    public function finalize()
    {
        if (!in_array(Auth::id(), $this->teacherIds)) {
            session()->flash('error', 'U bent niet gemachtigd om dit formulier te finaliseren.');
            return;
        }

        $draft = $this->getSharedDraft();

        $finalForm = $this->form;
        if ($draft) {
            $finalForm = $draft->draft_data;
        }

        GradingResult::create([
            'grading_form_id' => $this->gradingFormId,
            'student_id' => $this->studentId,
            'form_data' => $finalForm,
        ]);

        if ($draft) {
            $draft->delete();
        }

        session()->flash('message', 'Definitief opgeslagen!');
    }

    private function getSharedDraft()
    {
        return GradingResultDraft::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->whereHas('teachers', function($query) {
                $query->whereIn('teacher_id', $this->teacherIds);
            })
            ->with('teachers')
            ->first();
    }

    public function render()
    {
        return view('livewire.grading-template', [
            'form' => $this->form,
        ]);
    }
}
