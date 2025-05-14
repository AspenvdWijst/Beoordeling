<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $assignments = \App\Models\Assignment::all();
        $teachers = \App\Models\Teacher::all();

        foreach ($assignments as $assignment) {
            foreach ($teachers as $teacher) {
                \App\Models\AssignmentTeacher::create([
                    'assignment_id' => $assignment->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
