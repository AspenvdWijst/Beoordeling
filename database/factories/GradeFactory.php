<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'assignment_id' => Assignment::inRandomOrder()->first()?->id ?? Assignment::factory(),
            'student_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'teacher1_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'teacher2_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'grade' => $this->faker->randomFloat(1, 1, 10),
        ];
    }
}
