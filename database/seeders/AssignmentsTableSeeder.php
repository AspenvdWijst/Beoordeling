<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Assignment::factory(10)->create();
    }
}
