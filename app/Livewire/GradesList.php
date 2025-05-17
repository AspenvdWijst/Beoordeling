<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;

class GradesList extends Component
{
    public $grades;
    public $search = '';
    public $filteredGrades;

    public function mount($grades)
    {
        $this->grades = $grades;
        $this->filteredGrades = $grades;
    }

    public function updatedSearch($value)
    {
        // Filter the collection by the search term
        $this->filterGrades($value);
    }

    public function filterGrades($searchTerm = '')
    {
        $this->filteredGrades = $this->grades->filter(function ($grade) use ($searchTerm) {
            return stripos($grade->student?->name ?? '', $searchTerm) !== false;
        });
    }

    public function render()
    {

        return view('livewire.grades-list');
    }
}
