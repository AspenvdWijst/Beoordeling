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
        DB::table('student_subject')->insert([
            'student_id' => 5,
            'subject_id' => 1,
        ]);

        DB::table('student_subject')->insert([
            'student_id' => 6,
            'subject_id' => 1,
        ]);

        DB::table('student_subject')->insert([
            'student_id' => 7,
            'subject_id' => 1,
        ]);
    }
}
