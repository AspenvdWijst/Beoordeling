<?php

namespace App\Livewire;

use Livewire\Component;

class GradesList extends Component
{
    public $grades;

    public function mount($grades)
    {
        $this->grades = $grades;
    }
    public function render()
    {
        $unapprovedGrades = $this->grades->filter(function ($grade) {
            return $grade->approvals->count() < 2;
        });

        return view('livewire.grades-list', [
            'grades' => $unapprovedGrades,
        ]);
    }
}
