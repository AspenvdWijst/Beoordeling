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
        Grade::factory()->create([
            'assignment_id' => 1,
            'student_id' => 7,
            'teacher1_id' => 3,
            'teacher2_id' => 4,
            'grade' => 10,
        ]);

        Grade::factory()->create([
            'assignment_id' => 1,
            'student_id' => 5,
            'teacher1_id' => 3,
            'teacher2_id' => 4,
            'grade' => 10,
        ]);

        Grade::factory()->create([
            'assignment_id' => 1,
            'student_id' => 6,
            'teacher1_id' => 3,
            'teacher2_id' => 4,
            'grade' => 10,
        ]);

        Grade::factory()->create([
            'assignment_id' => 1,
            'student_id' => 5,
            'teacher1_id' => 3,
            'teacher2_id' => 4,
            'grade' => 10,
        ]);
    }
}
