<?php

namespace App\Livewire;

use App\Models\GradingForm;
use App\Models\GradingFormDraft;
use Livewire\Component;

class GradingFormLivewire extends Component
{
    public $formTitle = '';
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
    public $pointRange = '';

    public function mount()
    {
        // Initialize with one table by default
        $this->tables = [
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
            ]
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

    public function getTotalPoints($tableIndex)
    {
        return collect($this->tables[$tableIndex]['rows'])->sum('points');
    }

    public function getGrandTotalPoints()
    {
        $total = 0;
        foreach ($this->tables as $table) {
            if (isset($table['rows']) && is_array($table['rows'])) {
                foreach ($table['rows'] as $row) {
                    $total += isset($row['points']) ? (float)$row['points'] : 0;
                }
            }
        }
        return $total;
    }

    public function getMaxObtainablePointsProperty()
    {
        return collect($this->tables)->sum('maxObtainablePoints');
    }

    public function getMinObtainablePointsProperty()
    {
        return collect($this->tables)->sum('minObtainablePoints');
    }

    public function saveDraft() //TODO add $teacherIds when teacher link is complete
    {
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
                'pointRange' => $this->pointRange,
            ],
        ]);
//        $draft->teachers()->sync($teacherIds);

        session()->flash('message', 'Concept opgeslagen!');
    }

    public function save()
    {
        $this->validate([
            'formTitle' => 'required|string|max:255',
            'tables' => 'required|array|min:1',
            'tables.*.title' => 'required|string|max:255',
            'tables.*.rows' => 'required|array|min:1',
            'tables.*.rows.*.component' => 'required|string',
            'tables.*.rows.*.description' => 'required|string',
            'tables.*.rows.*.insufficient' => 'required|string',
            'tables.*.rows.*.sufficient' => 'required|string',
            'tables.*.rows.*.good' => 'required|string',
            'tables.*.rows.*.points' => 'required|numeric|min:0|max:5',
            'tables.*.rows.*.remarks' => 'nullable|string',
            'tables.*.knockoutCriteria' => 'array',
            'tables.*.knockoutCriteria.*.text' => 'required_if:tables.*.knockoutCriteria.*.checked,true',
            'tables.*.description_1' => 'nullable|string|max:255',
            'tables.*.description_2' => 'nullable|string|max:255',
            'tables.*.deliverable_text' => 'required_if:tables.*.deliverable_checked,true',
            'tables.*.maxObtainablePoints' => 'required|numeric|min:0',
            'tables.*.minObtainablePoints' => 'required|numeric|min:0',
            'tables.*.pointRange' => 'nullable|string|max:255',
        ]);

        \DB::transaction(function () {
            // Create the grading form
            $form = GradingForm::create([
                'title' => $this->formTitle,
                'student_name' => $this->student['name'],
                'student_number' => $this->student['number'],
                'company_name' => $this->company['name'],
                'company_place' => $this->company['place'],
                'start_period' => $this->period['start'],
                'end_period' => $this->period['end'],
                'oe_code' => $this->OEcode,
                'title_assignment' => $this->titleAssignment,
                'retry' => $this->retry ?? false,
                'grading_date' => $this->gradingDate,
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
                    'point_range' => $tableData['pointRange'] ?? '',
                ]);

                // Save all rows
                foreach ($tableData['rows'] as $row) {
                    $table->criteriaRows()->create([
                        'component'    => $row['component'] ?? '',
                        'description'  => $row['description'] ?? '',
                        'insufficient' => $row['insufficient'] ?? '',
                        'sufficient'   => $row['sufficient'] ?? '',
                        'good'         => $row['good'] ?? '',
                        'points'       => $row['points'] ?? 0,
                        'remarks'      => $row['remarks'] ?? '',
                    ]);
                }

                // Save all knockout criteria
                foreach ($tableData['knockoutCriteria'] as $criteria) {
                    $table->knockoutCriteria()->create([
                        'text'    => $criteria['text'] ?? '',
                        'checked' => $criteria['checked'] ?? false,
                    ]);
                }
            }
        });

        session()->flash('message', 'Beoordeling succesvol opgeslagen!');
    }
    public function render()
    {
        return view('livewire.grading-form-livewire');
    }
}
