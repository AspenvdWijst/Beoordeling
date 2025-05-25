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

    public $gradingFormId;
    public $studentId = 4;

    public function mount($gradingFormId)
    {
        $this->gradingFormId = $gradingFormId;
        $gradingForm = GradingForm::with(['tables.criteriaRows', 'tables.knockoutcriteria', 'tables.pointRanges'])->find($this->gradingFormId);

        if ($gradingForm) {
            $this->form = $gradingForm->toArray();
        }

        $draft = GradingResultDraft::where([
            'grading_form_id' => $this->gradingFormId,
            'student_id' => $this->studentId,
            'teacher_id' => Auth::id(),
        ])->first();

        if ($draft) {
            $this->form = $draft->draft_data;
        }
    }
    public function setPoints($tableIndex, $rowIndex, $points)
    {
        // Defensive: ensure indexes exist
        if (isset($this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex])) {
            $this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex]['points'] = $points;
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
        // Called via polling from frontend (JS or Livewire polling)
        // Optionally, merge other teachers' drafts for display
        $otherDrafts = GradingResultDraft::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->where('teacher_id', '!=', Auth::id())
            ->get();

        // You can merge or display these drafts as needed
        // For now, just emit an event or update a property
        $this->emit('otherDraftsUpdated', $otherDrafts->toArray());
    }

    public function saveDraft()
    {
        GradingResultDraft::updateOrCreate(
            [
                'grading_form_id' => $this->gradingFormId,
                'student_id' => $this->studentId,
                'teacher_id' => Auth::id(),
            ],
            [
                'draft_data' => $this->form,
            ]
        );
        session()->flash('message', 'Concept opgeslagen!');
    }

    public function finalize()
    {
        // Merge all drafts (simple example: take the latest from each teacher)
        $drafts = GradingResultDraft::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->get();

        // Merge logic: here, just combine all tables/rows (customize as needed)
        $finalForm = $this->form;
        foreach ($drafts as $draft) {
            // Example: you could merge per-table, per-row, or use the latest
            // For now, let's just take the latest draft as the final
            $finalForm = $draft->draft_data;
        }

        GradingResult::create([
            'grading_form_id' => $this->gradingFormId,
            'student_id' => $this->studentId,
            'form_data' => $finalForm,
        ]);

        // Optionally, delete drafts
        GradingResultDraft::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->delete();

        session()->flash('message', 'Definitief opgeslagen!');
    }

    public function render()
    {
        return view('livewire.grading-template', [
            'form' => $this->form,
        ]);
    }
}
