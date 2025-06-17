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
        Assignment::factory()->create([
            'subject_id' => 1,
            'assignment_name' => 'Beoordeling',
            'assignment_info' => 'In de module Software Development Project van ADSD leert de student de opgedane kennis praktisch toe te passen. Studenten werken aan echte opdrachten uit het bedrijfsleven, waarbij ze de HBO-i competenties kunnen demonstreren. Dit vereist niet alleen theoretische kennis, maar ook het vermogen om deze kennis praktisch in te zetten.'
        ]);
    }
}
