<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = Subject::all();
        $teachers = DB::table("users")->where("role_id", '2')->get();

        foreach ($subjects as $subject) {
            foreach ($teachers as $teacher) {
                DB::table('subject_teacher')->insert([
                    'subject_id' => $subject->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
