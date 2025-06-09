<?php

namespace Tests\Unit;

use App\Livewire\GradingFormLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Mockery;

class GradingFormLivewireTest extends TestCase
{
    use WithFaker;

    public function test_default_state_initialization()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $this->assertEquals('', $component->get('formTitle'));
        $this->assertEquals(['onvoldoende', 'voldoende', 'goed'], $component->get('labels'));
        $this->assertIsArray($component->get('tables'));
        $this->assertCount(1, $component->get('tables'));
    }

    public function test_add_table()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $initialTablesCount = count($component->get('tables'));
        $component->call('addTable');

        $this->assertEquals($initialTablesCount + 1, count($component->get('tables')));
        $this->assertArrayHasKey('title', $component->get('tables')[1]);
        $this->assertArrayHasKey('rows', $component->get('tables')[1]);
    }

    public function test_remove_table()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $component->call('addTable');
        $initialCount = count($component->get('tables'));
        $component->call('removeTable', 0);

        $this->assertEquals($initialCount - 1, count($component->get('tables')));
    }

    public function test_add_row_to_table()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $initialRowCount = count($component->get('tables')[0]['rows']);
        $component->call('addRow', 0);

        $this->assertEquals($initialRowCount + 1, count($component->get('tables')[0]['rows']));
    }

    public function test_calculate_max_obtainable_points()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $component->set('tables.0.maxObtainablePoints', 10);
        $component->call('addTable');
        $component->set('tables.1.maxObtainablePoints', 15);

        $this->assertEquals(25, $component->get('maxObtainablePoints'));
    }

    public function test_validation_rules()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $component->call('save');

        $component->assertHasErrors([
            'formTitle' => 'required',
            'selectedAssignment' => 'required',
            'tables.0.title' => 'required',
            'tables.0.deliverable_text' => 'required'
        ]);
    }

    public function test_mount_with_draft_data()
    {
        $draftData = [
            'formTitle' => 'Test Form',
            'tables' => [
                [
                    'title' => 'Test Table',
                    'rows' => [
                        [
                            'component' => 'Test Component',
                            'description' => 'Test Description',
                            'insufficient' => 'Test Insufficient',
                            'sufficient' => 'Test Sufficient',
                            'good' => 'Test Good',
                            'points' => 0,
                            'remarks' => ''
                        ]
                    ],
                    'knockoutCriteria' => [
                        'text' => 'Test Knockout Criteria',
                        'checked' => 0
                    ],
                    'maxObtainablePoints' => 25,
                    'minObtainablePoints' => 0,
                    'deliverable_text' => 'Test Deliverable'
                ]
            ]
        ];

        $component = Livewire::test(GradingFormLivewire::class, ['draftData' => $draftData]);

        $this->assertEquals('Test Form', $component->get('formTitle'));
        $this->assertEquals('Test Table', $component->get('tables')[0]['title']);
        $this->assertIsArray($component->get('tables')[0]['knockoutCriteria']);
        $this->assertIsArray($component->get('tables')[0]['rows']);
    }

    public function test_add_knockout_criteria()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        $initialCount = count($component->get('tables')[0]['knockoutCriteria']);
        $component->call('addKnockoutCriteria', 0);

        $this->assertEquals($initialCount + 1, count($component->get('tables')[0]['knockoutCriteria']));
    }

    public function test_remove_knockout_criteria()
    {
        $component = Livewire::test(GradingFormLivewire::class);

        // Add an extra knockout criteria first
        $component->call('addKnockoutCriteria', 0);
        $initialCount = count($component->get('tables')[0]['knockoutCriteria']);

        $component->call('removeKnockoutCriteria', 0, 0);

        $this->assertEquals($initialCount - 1, count($component->get('tables')[0]['knockoutCriteria']));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
