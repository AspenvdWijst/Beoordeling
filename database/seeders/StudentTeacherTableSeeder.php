<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = \App\Models\Student::all();
        $teachers = \App\Models\Teacher::all();

        foreach ($students as $student) {
            foreach ($teachers as $teacher) {
                \App\Models\StudentTeacher::create([
                    'student_id' => $student->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
