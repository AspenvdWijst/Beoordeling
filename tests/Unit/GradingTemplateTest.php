<?php

namespace Tests\Unit\Livewire;

use App\Livewire\GradingTemplate;
use PHPUnit\Framework\TestCase;

class GradingTemplateTest extends TestCase
{
    /** @test */
    public function points_to_grade_converts_correctly()
    {
        $component = new GradingTemplate();

        $this->assertEquals(5.0, $component->pointsToGrade(71));
        $this->assertEquals(5.5, $component->pointsToGrade(75));
        $this->assertEquals(6.0, $component->pointsToGrade(85));
        $this->assertEquals(7.0, $component->pointsToGrade(100));
        $this->assertEquals(8.0, $component->pointsToGrade(120));
        $this->assertEquals(10.0, $component->pointsToGrade(150));
    }

    /** @test */
    public function get_total_points_calculates_correctly()
    {
        $component = new GradingTemplate();

        $component->form = [
            'tables' => [
                [
                    'criteria_rows' => [
                        ['points' => 5],
                        ['points' => 3],
                    ]
                ]
            ]
        ];

        $this->assertEquals(8, $component->getTotalPoints(0));
    }

    /** @test */
    public function get_grand_total_points_sums_all_tables()
    {
        $component = new GradingTemplate();

        $component->form = [
            'tables' => [
                [
                    'criteria_rows' => [
                        ['points' => 5],
                        ['points' => 3],
                    ]
                ],
                [
                    'criteria_rows' => [
                        ['points' => 4],
                        ['points' => 2],
                    ]
                ]
            ]
        ];

        $this->assertEquals(14, $component->getGrandTotalPoints());
    }

    /** @test */
    public function get_max_obtainable_points_calculates_correctly()
    {
        $component = new GradingTemplate();

        $component->form = [
            'tables' => [
                ['max_points' => 10],
                ['max_points' => 20],
            ]
        ];

        $this->assertEquals(30, $component->getMaxObtainablePointsProperty());
    }

    /** @test */
    public function get_min_obtainable_points_calculates_correctly()
    {
        $component = new GradingTemplate();

        $component->form = [
            'tables' => [
                ['min_points' => 5],
                ['min_points' => 10],
            ]
        ];

        $this->assertEquals(15, $component->getMinObtainablePointsProperty());
    }
}
