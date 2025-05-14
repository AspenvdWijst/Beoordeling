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
                    'grade' => rand(40, 100)/10, // Random grade between 50 and 100
                ]);
            }
        }
    }
}
