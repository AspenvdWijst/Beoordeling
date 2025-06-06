<?php

namespace App\Livewire;

use App\Models\Grade;
use App\Models\GradingForm;
use App\Models\GradingResult;
use App\Models\GradingResultDraft;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class GradingTemplate extends Component
{
    public $form = [];
    public $teacherIds = [];
    public $gradingFormId;
    public $studentId = null;
    public $isEditing = false;
    public $lastUserAction = null;

    public $students;
    public $isStudentLocked = false;

    public bool $hasApproved = false;
    public bool $allApproved = false;

    public $teacherApprovals = [];

    public bool $retryLoaded = false;

    public bool $retryFilled = false;

    public function mount($gradingFormId)
    {
        $this->students = User::where('role_id', 1)->get();
        $this->gradingFormId = $gradingFormId;

        $gradingForm = GradingForm::with(['tables.criteriaRows', 'tables.knockoutcriteria', 'tables.pointRanges', 'assignment.teachers'])
            ->find($this->gradingFormId);

        if ($gradingForm) {
            $this->form = $gradingForm->toArray();

            if ($gradingForm->assignment) {
                $this->teacherIds = $gradingForm->assignment->teachers->pluck('id')->toArray();
            }
        }

        if (in_array(Auth::id(), $this->teacherIds)) {
            $draft = $this->getSharedDraft();

            if ($draft) {
                $this->form = $draft->draft_data;
            }
        }

        $this->updateFinalGrade();

        $this->updateApprovalStatus();
    }

    protected function rules()
    {
        return [
            'form.student_number' => 'required|numeric',
            'form.grading_date' => 'required|date|before_or_equal:today',
            'form.oe_code' => 'required|string|min:3|max:20',
            'form.start_period' => 'required|date',
            'form.end_period' => 'required|date|after:form.start_period',
            'form.title_assignment' => 'required|string|min:5|max:200',
            'form.company_name' => 'required|string|min:2|max:100',
            'form.company_place' => 'required|string|min:2|max:100',
        ];
    }

    protected function messages()
    {
        return [
            'form.student_number.required' => 'Studentnummer is verplicht.',

            'form.grading_date.required' => 'Datum beoordeling is verplicht.',
            'form.grading_date.date' => 'Voer een geldige datum in.',
            'form.grading_date.before_or_equal' => 'Datum beoordeling mag niet in de toekomst liggen.',

            'form.oe_code.required' => 'OE-code is verplicht.',
            'form.oe_code.min' => 'OE-code moet minimaal 3 karakters bevatten.',
            'form.oe_code.max' => 'OE-code mag maximaal 20 karakters bevatten.',

            'form.start_period.required' => 'Startdatum is verplicht.',
            'form.start_period.date' => 'Voer een geldige startdatum in.',

            'form.end_period.required' => 'Einddatum is verplicht.',
            'form.end_period.date' => 'Voer een geldige einddatum in.',
            'form.end_period.after' => 'Einddatum moet na de startdatum liggen.',

            'form.title_assignment.required' => 'Titel opdracht is verplicht.',
            'form.title_assignment.min' => 'Titel opdracht moet minimaal 5 karakters bevatten.',
            'form.title_assignment.max' => 'Titel opdracht mag maximaal 200 karakters bevatten.',

            'form.company_name.required' => 'Bedrijfsnaam is verplicht.',
            'form.company_name.min' => 'Bedrijfsnaam moet minimaal 2 karakters bevatten.',
            'form.company_name.max' => 'Bedrijfsnaam mag maximaal 100 karakters bevatten.',

            'form.company_place.required' => 'Bedrijfsplaats is verplicht.',
            'form.company_place.min' => 'Bedrijfsplaats moet minimaal 2 karakters bevatten.',
            'form.company_place.max' => 'Bedrijfsplaats mag maximaal 100 karakters bevatten.',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function setPoints($tableIndex, $rowIndex, $points)
    {
        if (!in_array(Auth::id(), $this->teacherIds)) {
            session()->flash('error', 'U bent niet gemachtigd om dit formulier te bewerken.');
            return;
        }

        if (isset($this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex])) {
            $this->form['tables'][$tableIndex]['criteria_rows'][$rowIndex]['points'] = $points;
            $this->validateOnly("form.tables.{$tableIndex}.criteria_rows.{$rowIndex}.points");
            $this->markUserAction();
            $this->saveDraft();
        }
    }

    public function lockStudent()
    {
        if ($this->studentId) {
            $this->isStudentLocked = true;
        }
    }

    public function getStudentNameProperty()
    {
        if (!$this->studentId) {
            return '';
        }
        $student = $this->students->where('id', $this->studentId)->first();
        $this->form['student_name'] = $student->name;
        return $student ? $student->name : 'Onbekende student';
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

        if ($this->lastUserAction && $this->lastUserAction->diffInSeconds(now()) < 5) {
            return;
        }

        $draft = $this->getSharedDraft();

        if ($draft && $draft->updated_at > $this->lastUserAction) {
            $this->form = $draft->draft_data;
        }

        $this->updateApprovalStatus();
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'form.') && in_array(Auth::id(), $this->teacherIds)) {

            $this->markUserAction();
            $this->validateOnly($propertyName);

            if (str_contains($propertyName, '.points')) {
                $this->updateFinalGrade();
                return;
            }

            $this->updateFinalGrade();
            $this->saveDraftDelayed();
        }
    }

    private function markUserAction()
    {
        $this->isEditing = true;
        $this->lastUserAction = now();

        $this->dispatch('user-action-detected');
    }

    public function saveDraftDelayed()
    {
        $this->saveDraft();
    }

    public function saveDraft()
    {
        $studentId = (int) $this->studentId;

        if (!in_array(Auth::id(), $this->teacherIds)) {
            session()->flash('error', 'U bent niet gemachtigd om dit formulier op te slaan.');
            return;
        }

        $this->updateFinalGrade();

        try {
            $draft = GradingResultDraft::firstOrCreate(
                [
                    'grading_form_id' => $this->gradingFormId,
                    'student_id' =>  $studentId,
                ],
                [
                    'draft_data' => $this->form,
                ]
            );

            $draft->update(['draft_data' => $this->form]);

            $draft->teachers()->sync($this->teacherIds);

            $this->lastUserAction = now();

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
            session()->flash('error', 'U bent niet gemachtigd om dit formulier goed te keuren.');
            return;
        }

        try {
            $this->validate();
        } catch (\Exception $e) {
            session()->flash('error', 'Er zijn validatiefouten. Controleer alle velden voordat u goedkeurd.');
            $this->validate();
            return;
        }

        $draft = $this->getSharedDraft();

        if (!$draft) {
            session()->flash('error', 'Concept niet gevonden!');
            return;
        }

        $draft->teachers()->updateExistingPivot(Auth::id(), [
           'approved' => true,
            'approved_at' => now(),
        ]);

        $draft->load('teachers');

        if (method_exists($draft, 'allTeachersApproved') && $draft->allTeachersApproved()) {
            $finalform = $draft->draft_data;

            $grandTotal = $this->getGrandTotalPoints();
            $finalGrade = $this->pointsToGrade($grandTotal);
            $finalform['finalGrade'] = $finalGrade;

            GradingResult::create([
                'grading_form_id' => $this->gradingFormId,
                'student_id'=> $this->studentId,
                'form_data' => $finalform,
            ]);

//            Grade::updateOrCreate([
//               'assignment_id' => $this->form['assignment_id'],
//                'student_id'=> $this->studentId,
//                'teacher_1_id' => null,
//                'teacher_2_id' => null,
//                'grade' => $finalGrade,
//                'approved' => 0,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);

            $draft->delete();

            session()->flash('success', 'Definitief opgeslagen! Alle docenten hebben goedgekeurd.');

            $this->dispatch('delayed-redirect', url()->route('dashboard'));
        } else {
            session()->flash('message', 'Uw beoordeling is goedgekeurd. Wacht op de andere docent.');

            $this->dispatch('delayed-redirect', url()->route('dashboard'));
        }

        $this->updateApprovalStatus();
    }

    private function getSharedDraft()
    {
        $studentId = (int) $this->studentId;
        return GradingResultDraft::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $studentId)
            ->whereHas('teachers', function($query) {
                $query->whereIn('teacher_id', $this->teacherIds);
            })
            ->with('teachers')
            ->first();
    }

    public function updateApprovalStatus()
    {
        $draft = $this->getSharedDraft();
        if ($draft) {
            $this->hasApproved = $draft->isApprovedByTeacher(Auth::id());
            $this->allApproved = $draft->allTeachersApproved();

            $this->teacherApprovals = [];
            foreach ($draft->teachers as $teacher) {
                $this->teacherApprovals[] = [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'approved' => $teacher->pivot->approved,
                    'approved_at' => $teacher->pivot->approved_at,
                ];
            }
        } else {
            $this->hasApproved = false;
            $this->allApproved = false;
            $this->teacherApprovals = [];
        }
    }

    public function pointsToGrade($points)
    {
        $conversionTable = [
            ['min' => 72, 'max' => 79, 'grade' => 5.5],
            ['min' => 80, 'max' => 89, 'grade' => 6],
            ['min' => 90, 'max' => 97, 'grade' => 6.5],
            ['min' => 98, 'max' => 105, 'grade' => 7],
            ['min' => 106, 'max' => 114, 'grade' => 7.5],
            ['min' => 115, 'max' => 123, 'grade' => 8],
            ['min' => 124, 'max' => 131, 'grade' => 8.5],
            ['min' => 132, 'max' => 140, 'grade' => 9],
            ['min' => 141, 'max' => 148, 'grade' => 9.5],
            ['min' => 149, 'max' => 150, 'grade' => 10],
        ];

        foreach ($conversionTable as $row) {
            if ($points >= $row['min'] && $points <= $row['max']) {
                return $row['grade'];
            }
        }

        return 5;
    }

    public function updateFinalGrade()
    {
        $grandTotal = $this->getGrandTotalPoints();
        $this->form['finalGrade'] = $this->pointsToGrade($grandTotal);
    }

    public function updatedStudentId($value)
    {
        $this->studentId = $value;

        $existingFalse = GradingResult::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->where(function($q) {
                $q->where('form_data->retry', false)->orWhereNull('form_data->retry');
            })
            ->first();

        $existingTrue = GradingResult::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', $this->studentId)
            ->where('form_data->retry', true)
            ->first();

        if($existingTrue) {
            $this->retryFilled = true;
        } else {
            $this->retryFilled = false;
        }

        if ($existingFalse && $existingTrue) {
            session()->flash('error', 'De mogelijke rubrieken zijn al gemaakt.');
            $this->dispatch('delayed-redirect', url()->route('dashboard'));
            return;
        }

        $this->loadExistingResultForStudent();
    }

    private function loadExistingResultForStudent()
    {
        $this->retryLoaded = false;
        $existingResult = GradingResult::where('grading_form_id', $this->gradingFormId)
            ->where('student_id', (int) $this->studentId)
            ->first();

        if (
            $existingResult &&
            isset($existingResult->form_data['retry']) &&
            (int)$existingResult->form_data['retry'] === 0
        ) {
            $formData = $existingResult->form_data;
            $formData['retry'] = true;
            $formData['title'] = 'Herkansing: ' . $formData['title'];
            $formData['grading_date'] = '';
            $this->form = $formData;
            $this->retryLoaded = true;
        }
    }


    public function render()
    {
        return view('livewire.grading-template', [
            'form' => $this->form,
        ]);
    }
}
