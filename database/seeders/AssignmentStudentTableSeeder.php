<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assignment_student')->insert([
            'assignment_id' => 1,
            'student_id' => 5,
        ]);

        DB::table('assignment_student')->insert([
            'assignment_id' => 1,
            'student_id' => 6,
        ]);

        DB::table('assignment_student')->insert([
            'assignment_id' => 1,
            'student_id' => 7,
        ]);
    }
}
