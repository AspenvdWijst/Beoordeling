<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $assignments = Assignment::all();
        $students = Student::all();

    }
}
