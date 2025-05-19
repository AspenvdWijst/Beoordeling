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
        $assignments = Assignment::all();
        $students = DB::table("users")->where("role_id", '1')->get();

        foreach ($students as $student) {
            foreach ($assignments as $assignment) {
                DB::table('assignment_student')->insert([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                ]);
            }
        }
    }
}
