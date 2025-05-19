<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = Assignment::all();
        $teachers = DB::table("users")->where("role_id", '2')->get();

        foreach ($teachers as $teacher) {
            foreach ($assignments as $assignment) {
                DB::table('assignment_teacher')->insert([
                    'assignment_id' => $assignment->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
