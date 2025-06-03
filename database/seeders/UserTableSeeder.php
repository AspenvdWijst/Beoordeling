<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@windesheim.nl',
            'password' => 'admin',
            'role_id' => 3
        ]);

        User::factory()->create([
            'name' => 'Admin2',
            'email' => 'admin2@windesheim.nl',
            'password' => 'admin',
            'role_id' => 3
        ]);

        User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@windesheim.nl',
            'password' => 'teacher',
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Teacher2',
            'email' => 'teacher2@windesheim.nl',
            'password' => 'teacher2',
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@windesheim.nl',
            'password' => 'student',
            'role_id' => 1
        ]);

        User::factory()->count(20)->create();
    }
}
