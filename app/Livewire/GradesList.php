<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;

class GradesList extends Component
{
    public $grades;
    public $search = '';

    public function mount($grades)
    {
        $this->grades = $grades;  // Assume it's a collection
    }

    public function render()
    {
        // Filter unapproved grades
        $unapprovedGrades = $this->grades->filter(function ($grade) {
            return !$grade->approved;
        });

        // If there's a search term, filter by student name in memory
        if (trim($this->search) !== '') {
            $unapprovedGrades = $unapprovedGrades->filter(function ($grade) {
                return stripos($grade->student?->name ?? '', $this->search) !== false;
            });
        }

        return view('livewire.grades-list', [
            'grades' => $unapprovedGrades,  // Pass filtered grades to the view
        ]);
    }
}
