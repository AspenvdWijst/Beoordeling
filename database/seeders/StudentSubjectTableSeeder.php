<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = \App\Models\Student::all();
        $subjects = \App\Models\Subject::all();

        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                \App\Models\StudentSubject::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
