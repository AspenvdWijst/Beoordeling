<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // You can modify as needed for random grades
        $assignments = \App\Models\Assignment::all();
        $students = \App\Models\Student::all();

        foreach ($assignments as $assignment) {
            foreach ($students as $student) {
                \App\Models\Grade::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'grade' => rand(40, 100)/10, // Random grade between 50 and 100
                ]);
            }
        }
    }
}
