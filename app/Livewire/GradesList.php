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
        $this->grades = $grades;
    }

    public function render()
    {
        // Filter grades that are not approved
        $unapprovedGrades = $this->grades->filter(function ($grade) {
            return !$grade->approved;
        });

        // Apply the search filter only for student names
        if (trim($this->search !== '')) {
            $unapprovedGrades = $unapprovedGrades->filter(function ($grade) {
                return stripos($grade->student?->name ?? '', $this->search) !== false;
            });
        }

        return view('livewire.grades-list', [
            'grades' => $unapprovedGrades,
        ]);
    }
}
