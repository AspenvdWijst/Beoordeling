<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = DB::table("users")->where("role_id", '1')->get();
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            foreach ($students as $student) {
                DB::table('student_subject')->insert([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }

    }
}
