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
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@windesheim.nl',
            'password' => 'admin',
            'role_id' => 3
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Beheerder',
            'email' => 'beheerder@windesheim.nl',
            'password' => 'admin',
            'role_id' => 3
        ]);

        User::factory()->create([
            'id' => 3,
            'name' => 'Jan Zuur',
            'email' => 'jan@windesheim.nl',
            'password' => 'teacher',
            'role_id' => 2
        ]);

        User::factory()->create([
            'id' => 4,
            'name' => 'Arie Ismaiel',
            'email' => 'arie@windesheim.nl',
            'password' => 'teacher2',
            'role_id' => 2
        ]);

        User::factory()->create([
            'id' => 5,
            'name' => 'Aspen van der Wijst',
            'email' => 'aspen@windesheim.nl',
            'password' => 'student',
            'role_id' => 1
        ]);

        User::factory()->create([
            'id' => 6,
            'name' => 'Ruben van der Ark',
            'email' => 'ruben@windesheim.nl',
            'password' => 'student',
            'role_id' => 1
        ]);

        User::factory()->create([
            'id' => 7,
            'name' => 'Rob Loeffen',
            'email' => 'rob@windesheim.nl',
            'password' => 'student',
            'role_id' => 1
        ]);
    }
}
