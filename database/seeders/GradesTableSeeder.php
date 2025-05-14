<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // You can modify as needed for random grades
        $assignments = Assignment::all();
        $students = Student::all();

        foreach ($assignments as $assignment) {
            foreach ($students as $student) {
                Grade::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'grade' => rand(40, 100)/10, // Random grade between 50 and 100
                ]);
            }
        }
    }
}
