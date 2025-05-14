<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $assignments = Assignment::all();
        $teachers = Teacher::all();

    }
}
