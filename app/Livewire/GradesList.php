<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GradesList extends Component
{
    public $grades;
    public $search = '';
    public $filteredGrades;

    public function mount($grades = null)
    {
        $user = Auth::user();

        if ($user->role_id === 2) {
            $assignmentIds = $user->assignments()->pluck('assignments.id');



            $this->grades = Grade::whereIn('assignment_id', $assignmentIds)
                ->get();
            dd($assignmentIds);

        } else {
            $this->grades = $grades ?? Grade::with(['student', 'assignment'])->get();
        }

        $this->filteredGrades = $this->grades;
    }

    public function updatedSearch($value)
    {
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
