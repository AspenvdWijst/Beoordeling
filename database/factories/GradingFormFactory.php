<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\GradingForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradingFormFactory extends Factory
{
    protected $model = GradingForm::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'student_name' => '',
            'student_number' => '',
            'company_name' => '',
            'company_place' => '',
            'start_period' => null,
            'end_period' => null,
            'oe_code' => '',
            'title_assignment' => '',
            'retry' => false,
            'grading_date' => null,
            'assignment_id' => Assignment::factory(),
        ];
    }
}
