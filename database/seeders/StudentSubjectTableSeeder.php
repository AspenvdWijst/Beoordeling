<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = Student::all();
        $subjects = Subject::all();

    }
}
