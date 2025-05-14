<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();

    }
}
