<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'subject_name' => $this->faker->word . ' Studies',
            'student_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
