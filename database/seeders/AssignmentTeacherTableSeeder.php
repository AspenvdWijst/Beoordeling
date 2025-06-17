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
        DB::table('assignment_teacher')->insert([
            'assignment_id' => 1,
            'teacher_id' => 3,
        ]);

        DB::table('assignment_teacher')->insert([
            'assignment_id' => 1,
            'teacher_id' => 4,
        ]);
    }
}
