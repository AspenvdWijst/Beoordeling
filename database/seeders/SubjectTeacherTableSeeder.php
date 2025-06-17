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
        DB::table('subject_teacher')->insert([
            'subject_id' => 1,
            'teacher_id' => 4,
        ]);

        DB::table('subject_teacher')->insert([
            'subject_id' => 1,
            'teacher_id' => 3,
        ]);
    }
}
