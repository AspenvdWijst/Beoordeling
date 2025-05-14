<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Assignment::class;

    public function definition()
    {
        return [
            'subject_id' => Subject::inRandomOrder()->first()?->id ?? Subject::factory(),
            'assignment_name' => $this->faker->sentence(3),
            'assignment_info' => $this->faker->paragraph,
        ];
    }
}
