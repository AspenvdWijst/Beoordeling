<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $assignments = \App\Models\Assignment::all();
        $students = \App\Models\Student::all();

        foreach ($assignments as $assignment) {
            foreach ($students as $student) {
                \App\Models\AssignmentStudent::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                ]);
            }
        }
    }
}
