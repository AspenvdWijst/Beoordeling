<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // You can modify as needed for random grades
        $assignments = Assignment::all();
        $students = DB::table("users")->where("role_id", '1')->get();

        foreach ($assignments as $assignment) {
            foreach ($students as $student) {
                Grade::factory()->create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'teacher1_id' => null,
                    'teacher2_id' => null,
                ]);
            }
        }

        Grade::factory()->create([
            'assignment_id' => 3,
            'student_id' => 4,
            'teacher1_id' => null,
            'teacher2_id' => null,
        ]);

        Grade::factory()->create([
            'assignment_id' => 2,
            'student_id' => 4,
            'teacher1_id' => null,
            'teacher2_id' => null,
        ]);

        Grade::factory()->create([
            'assignment_id' => 4,
            'student_id' => 4,
            'teacher1_id' => null,
            'teacher2_id' => null,
        ]);

        Grade::factory()->create([
            'assignment_id' => 1,
            'student_id' => 4,
            'teacher1_id' => null,
            'teacher2_id' => null,
        ]);
    }
}
