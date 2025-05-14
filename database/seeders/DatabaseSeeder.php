<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Couchbase\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@windesheim.nl',
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
            'name' => 'Student',
            'email' => 'student@windesheim.nl',
            'password' => 'student',
            'role_id' => 1
        ]);

        $this->call([
            StudentsTableSeeder::class,
            SubjectsTableSeeder::class,
            TeachersTableSeeder::class,
            AssignmentsTableSeeder::class,
            GradesTableSeeder::class,
            AssignmentStudentTableSeeder::class,
            AssignmentTeacherTableSeeder::class,
            StudentSubjectTableSeeder::class,
            StudentTeacherTableSeeder::class,
            SubjectTeacherTableSeeder::class,
        ]);
    }
}
