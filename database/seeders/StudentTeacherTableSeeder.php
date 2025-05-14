<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = Student::all();
        $teachers = Teacher::all();

    }
}
