<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = \App\Models\Subject::all();
        $teachers = \App\Models\Teacher::all();

        foreach ($subjects as $subject) {
            foreach ($teachers as $teacher) {
                \App\Models\SubjectTeacher::create([
                    'subject_id' => $subject->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
