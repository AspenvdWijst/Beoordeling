<?php

namespace Tests\Feature\Livewire;

use App\Livewire\GradingFormLivewire;
use App\Models\Assignment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GradingFormLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_mounts_with_default_data()
    {
        Livewire::test(GradingFormLivewire::class)
            ->assertSet('formTitle', '')
            ->assertSet('tables.0.title', '');
    }

    public function test_it_mounts_with_draft_data()
    {
        $assignment = Assignment::factory()->create();
        $draftData = [
            'formTitle' => 'Test Form',
            'tables' => [],
            'assignment_id' => $assignment->id,
        ];
        Livewire::test(GradingFormLivewire::class, ['draftData' => $draftData])
            ->assertSet('formTitle', 'Test Form')
            ->assertSet('selectedAssignment', $assignment->id);
    }

    public function test_it_can_add_and_remove_tables()
    {
        $component = Livewire::test(GradingFormLivewire::class);
        $component->call('addTable');
        $component->assertCount('tables', 2);

        $component->call('removeTable', 0);
        $component->assertCount('tables', 1);
    }

    public function test_it_can_add_and_remove_rows()
    {
        $component = Livewire::test(GradingFormLivewire::class);
        $component->call('addRow', 0);
        $component->assertCount('tables.0.rows', 2);

        $component->call('removeRow', 0, 1);
        $component->assertCount('tables.0.rows', 1);
    }

    public function test_it_can_add_and_remove_knockout_criteria()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $component->call('addKnockoutCriteria', 0);
        $component->assertCount('tables.0.knockoutCriteria', 2);
        $component->call('removeKnockoutCriteria', 0, 0);
        $component->assertCount('tables.0.knockoutCriteria', 1);
    }

    public function test_it_validates_required_fields()
    {
        $component = Livewire::test(GradingFormLivewire::class);
        $component->set('formTitle', '');
        $component->set('selectedAssignment', null);

        $component->call('save')
            ->assertHasErrors(['formTitle', 'selectedAssignment']);
    }

    public function test_it_can_save_a_draft()
    {
        $assignment = Assignment::factory()->create();
        $component = Livewire::test(GradingFormLivewire::class);
        $component->set('formTitle', 'Draft Title');
        $component->set('selectedAssignment', $assignment->id);
        $component->call('saveDraft');

        $this->assertDatabaseHas('grading_form_drafts', [
            'title' => 'Draft Title',
        ]);
    }

    public function test_it_can_save_a_form()
    {
        $assignment = Assignment::factory()->create();

        $component = Livewire::test(GradingFormLivewire::class);
        $component->set('formTitle', 'Final Form');
        $component->set('selectedAssignment', $assignment->id);
        $component->set('tables', [
            [
                'title' => 'test table',
                'description_1' => 'first description',
                'description_2' => 'second description',
                'deliverable_text' => 'deliverable text',
                'deliverable_checked' => false,
                'maxObtainablePoints' => 25,
                'minObtainablePoints' => 0,
                'rows' => [
                    [
                        'component' => 'text',
                        'description' => 'this is a text row',
                        'insufficient' => 'this is insufficient',
                        'sufficient' => 'this is sufficient',
                        'good' => 'this is good',
                        'points' => 0,
                        'remarks' => 'this is a remark',
                    ]
                ],
                'knockoutCriteria' => [
                    [
                        'text' => 'this is a knockout criterion',
                        'checked' => false
                    ]
                ],
                'pointRanges' => [
                    ['label' => 'onvoldoende', 'min_points' => 1, 'max_points' => 2],
                    ['label' => 'voldoende', 'min_points' => 1, 'max_points' => 2],
                    ['label' => 'goed', 'min_points' => 1, 'max_points' => 2],
                ]
            ],
        ]);
        $component->call('save');

        $this->assertDatabaseHas('grading_forms', [
            'title' => 'Final Form',
            'assignment_id' => $assignment->id,
        ]);
    }
}
