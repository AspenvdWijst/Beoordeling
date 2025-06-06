<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\GradingForm;
use App\Models\GradingFormDraft;
use Livewire\Component;

class GradingFormLivewire extends Component
{
    public $formTitle = '';
    public $labels = ['onvoldoende', 'voldoende', 'goed'];
    public $tables = [];
    public $student = [
        'name' => '',
        'number' => '',
    ];
    public $company = [
        'name' => '',
        'place' => '',
    ];
    public $period = [
        'start' => '',
        'end' => '',
    ];
    public $OEcode = '';
    public $titleAssignment = '';
    public $retry = false;
    public $gradingDate = '';

    public $assignments = [];
    public $selectedAssignment = null;

    public $draftId = null;
    public function mount($draftData = null, $draftId = null)
    {
        $this->assignments = Assignment::all();

        if ($draftData) {
            $this->formTitle = $draftData['formTitle'] ?? '';
            $this->tables = $draftData['tables'] ?? $this->getDefaultTables();
            $this->student = $draftData['student'] ?? ['name' => '', 'number' => ''];
            $this->company = $draftData['company'] ?? ['name' => '', 'place' => ''];
            $this->period = $draftData['period'] ?? ['start' => '', 'end' => ''];
            $this->OEcode = $draftData['OEcode'] ?? '';
            $this->titleAssignment = $draftData['titleAssignment'] ?? '';
            $this->retry = $draftData['retry'] ?? false;
            $this->gradingDate = $draftData['gradingDate'] ?? '';
            $this->selectedAssignment = $draftData['assignment_id'] ?? null;
        } else {
            $this->tables = $this->getDefaultTables();
        }

        if ($draftId) {
            $this->draftId = $draftId;
        }
    }

    protected function getDefaultTables()
    {
        return [
            [
                'title' => '',
                'description_1' => '',
                'description_2' => '',
                'deliverable_text' => '',
                'deliverable_checked' => false,
                'maxObtainablePoints' => 0,
                'minObtainablePoints' => 0,
                'pointRange' => '',
                'rows' => [
                    [
                        'component' => '',
                        'description' => '',
                        'insufficient' => '',
                        'sufficient' => '',
                        'good' => '',
                        'points' => 0,
                        'remarks' => ''
                    ]
                ],
                'knockoutCriteria' => [
                    [
                        'text' => '',
                        'checked' => false
                    ]
                ],
                'pointRanges' => [
                    ['label' => 'onvoldoende', 'min_points' => null, 'max_points' => null],
                    ['label' => 'voldoende', 'min_points' => null, 'max_points' => null],
                    ['label' => 'goed', 'min_points' => null, 'max_points' => null],
                ]
            ]
        ];
    }

    public function addTable()
    {
        $this->tables[] = [
            'title' => '',
            'description_1' => '',
            'description_2' => '',
            'deliverable_text' => '',
            'deliverable_checked' => false,
            'maxObtainablePoints' => 0,
            'minObtainablePoints' => 0,
            'pointRange' => '',
            'rows' => [
                [
                    'component' => '',
                    'description' => '',
                    'insufficient' => '',
                    'sufficient' => '',
                    'good' => '',
                    'points' => 0,
                    'remarks' => ''
                ]
            ],
            'knockoutCriteria' => [
                [
                    'text' => '',
                    'checked' => false
                ]
            ],
            'pointRanges' => [
                ['label' => 'onvoldoende', 'min_points' => null, 'max_points' => null],
                ['label' => 'voldoende', 'min_points' => null, 'max_points' => null],
                ['label' => 'goed', 'min_points' => null, 'max_points' => null],
            ]
        ];
    }

    protected function rules()
    {
        return [
            'formTitle' => 'required|string|max:255',
            'selectedAssignment' => 'required|exists:assignments,id',

            'tables' => 'required|array|min:1',
            'tables.*.title' => 'required|string|max:255',
            'tables.*.description_1' => 'nullable|string|max:255',
            'tables.*.description_2' => 'nullable|string|max:255',
            'tables.*.deliverable_text' => 'required|string|max:255',
            'tables.*.maxObtainablePoints' => 'required|numeric|min:0',
            'tables.*.minObtainablePoints' => 'required|numeric|min:0',
            'tables.*.rows' => 'required|array|min:1',
            'tables.*.rows.*.component' => 'required|string|max:255',
            'tables.*.rows.*.description' => 'required|string|max:255',
            'tables.*.rows.*.insufficient' => 'required|string|max:255',
            'tables.*.rows.*.sufficient' => 'required|string|max:255',
            'tables.*.rows.*.good' => 'required|string|max:255',
            'tables.*.knockoutCriteria' => 'array|min:1',
            'tables.*.knockoutCriteria.*.text' => 'required|string|max:255',
            'tables.*.pointRanges' => 'array|size:3',
            'tables.*.pointRanges.*.label' => 'required|string|max:50',
            'tables.*.pointRanges.*.min_points' => 'required|numeric|min:0',
            'tables.*.pointRanges.*.max_points' => 'required|numeric|min:0',
        ];
    }

    protected function messages()
    {
        return [
            'formTitle.required' => 'De titel van het formulier is verplicht.',
            'selectedAssignment.required' => 'Selecteer een opdracht.',
            'selectedAssignment.exists' => 'De geselecteerde opdracht bestaat niet.',

            'tables.required' => 'Er moet minimaal één beoordelingscategorie zijn.',
            'tables.*.title.required' => 'Elke tabel moet een titel hebben.',
            'tables.*.rows.required' => 'Elke tabel moet minimaal één criterium hebben.',
            'tables.*.rows.*.component.required' => 'Elke rij moet een component hebben.',
            'tables.*.rows.*.description.required' => 'Elke rij moet een beschrijving hebben.',
            'tables.*.rows.*.insufficient.required' => 'Elke rij moet een omschrijving voor onvoldoende hebben.',
            'tables.*.rows.*.sufficient.required' => 'Elke rij moet een omschrijving voor voldoende hebben.',
            'tables.*.rows.*.good.required' => 'Elke rij moet een omschrijving voor goed hebben.',
            'tables.*.knockoutCriteria.*.text.required' => 'Elke knockout-criterium moet tekst bevatten.',
            'tables.*.deliverable_text.required' => 'Elke deliverable moet tekst bevatten.',
        ];
    }
    public function removeTable($tableIndex)
    {
        unset($this->tables[$tableIndex]);
        $this->tables = array_values($this->tables);
    }

    public function addRow($tableIndex)
    {
        $this->tables[$tableIndex]['rows'][] = [
            'component' => '',
            'description' => '',
            'insufficient' => '',
            'sufficient' => '',
            'good' => '',
            'points' => 0,
            'remarks' => ''
        ];
    }

    public function removeRow($tableIndex, $rowIndex)
    {
        if (count($this->tables[$tableIndex]['rows']) > 1) {
            unset($this->tables[$tableIndex]['rows'][$rowIndex]);
            $this->tables[$tableIndex]['rows'] = array_values($this->tables[$tableIndex]['rows']);
        }
    }

    public function addKnockoutCriteria($tableIndex)
    {
        $this->tables[$tableIndex]['knockoutCriteria'][] = [
            'text' => '',
            'checked' => false
        ];
    }

    public function removeKnockoutCriteria($tableIndex, $koIndex)
    {
        if (count($this->tables[$tableIndex]['knockoutCriteria']) > 1) {
            unset($this->tables[$tableIndex]['knockoutCriteria'][$koIndex]);
            $this->tables[$tableIndex]['knockoutCriteria'] = array_values($this->tables[$tableIndex]['knockoutCriteria']);
        }
    }

    public function getMaxObtainablePointsProperty()
    {
        return collect($this->tables)->sum('maxObtainablePoints');
    }

    public function getMinObtainablePointsProperty()
    {
        return collect($this->tables)->sum('minObtainablePoints');
    }

    public function saveDraft()
    {
        if ($this->draftId) {
            $draft = GradingFormDraft::find($this->draftId);
            if ($draft) {
                $draft->update([
                    'title' => $this->formTitle,
                    'form_data' => [
                        'formTitle' => $this->formTitle,
                        'tables' => $this->tables,
                        'student' => $this->student,
                        'company' => $this->company,
                        'period' => $this->period,
                        'OEcode' => $this->OEcode,
                        'titleAssignment' => $this->titleAssignment,
                        'retry' => $this->retry,
                        'gradingDate' => $this->gradingDate,
                        'assignment_id' => $this->selectedAssignment,
                    ],
                ]);
            }
        } else {
            $draft = GradingFormDraft::create([
                'title' => $this->formTitle,
                'form_data' => [
                    'formTitle' => $this->formTitle,
                    'tables' => $this->tables,
                    'student' => $this->student,
                    'company' => $this->company,
                    'period' => $this->period,
                    'OEcode' => $this->OEcode,
                    'titleAssignment' => $this->titleAssignment,
                    'retry' => $this->retry,
                    'gradingDate' => $this->gradingDate,
                    'assignment_id' => $this->selectedAssignment,
                ],
            ]);
            $this->draftId = $draft->id;
        }

        session()->flash('message', 'Concept opgeslagen!');
        $this->dispatch('delayed-redirect', url()->route('dashboard'));
    }

    public function save()
    {
        try {
            $this->validate();
        } catch (\Exception $e) {
            session()->flash('error', 'Er zijn validatiefouten. Controleer alle velden voordat u goedkeurd.');
            $this->validate();
            return;
        }

        \DB::transaction(function () {
            $form = GradingForm::create([
                'title' => $this->formTitle,
                'student_name' => $this->student['name'],
                'student_number' => $this->student['number'],
                'company_name' => $this->company['name'],
                'company_place' => $this->company['place'],
                'start_period' => $this->period['start'],
                'end_period' => $this->period['end'],
                'oe_code' => $this->OEcode,
                'title_assignment' => (int) $this->titleAssignment,
                'retry' => $this->retry ?? false,
                'grading_date' => $this->gradingDate,
                'assignment_id' => $this->selectedAssignment,
            ]);

            foreach ($this->tables as $tableData) {
                $table = $form->tables()->create([
                    'title' => $tableData['title'],
                    'description_1' => $tableData['description_1'],
                    'description_2' => $tableData['description_2'],
                    'deliverable_text' => $tableData['deliverable_text'] ?? '',
                    'deliverable_checked' => $tableData['deliverable_checked'] ?? false,
                    'max_points' => $tableData['maxObtainablePoints'],
                    'min_points' => $tableData['minObtainablePoints'],
                ]);

                // Save all rows
                foreach ($tableData['rows'] as $row) {
                    $table->criteriaRows()->create([
                        'component'    => $row['component'] ?? '',
                        'description'  => $row['description'] ?? '',
                        'insufficient' => $row['insufficient'] ?? '',
                        'sufficient'   => $row['sufficient'] ?? '',
                        'good'         => $row['good'] ?? '',
                        'points'       => 0,
                        'remarks'      => '',
                    ]);
                }

                // Save all knockout criteria
                foreach ($tableData['knockoutCriteria'] as $criteria) {
                    $table->knockoutCriteria()->create([
                        'text'    => $criteria['text'] ?? '',
                        'checked' => false,
                    ]);
                }

                if (isset($tableData['pointRanges'])) {
                    foreach ($tableData['pointRanges'] as $range) {
                        $table->pointRanges()->create([
                            'label'      => $range['label'],
                            'min_points' => $range['min_points'],
                            'max_points' => $range['max_points'],
                        ]);
                    }
                }
            }
        });

        if ($this->draftId) {
            GradingFormDraft::where('id', $this->draftId)->delete();
        }

        $this->dispatch('delayed-redirect', url()->route('dashboard'));

        session()->flash('message', 'Beoordeling succesvol opgeslagen!');
    }
    public function render()
    {
        return view('livewire.grading-form-livewire', [
            'maxObtainablePoints' => $this->maxObtainablePoints,
            'minObtainablePoints' => $this->minObtainablePoints,
        ]);
    }
}
