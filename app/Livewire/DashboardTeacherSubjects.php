<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardTeacherSubjects extends Component
{
    public $subjects;
    public $search = '';
    public $filteredSubjects;

    public function mount()
    {
        $teacher = Auth::user();
        $this->subjects = $teacher->subjects;
        $this->filteredSubjects = $this->subjects;
    }

    public function updatedSearch()
    {
        $this->filterSubjects();
    }

    public function filterSubjects()
    {
        if (trim($this->search) === '') {
            $this->filteredSubjects = $this->subjects;
        } else {
            $searchLower = strtolower($this->search);
            $this->filteredSubjects = $this->subjects->filter(function ($subject) use ($searchLower) {
                return str_contains(strtolower($subject->subject_name), $searchLower);
            });
        }
    }

    public function render()
    {
        return view('livewire.dashboard-teacher-subjects', [
            'filteredSubjects' => $this->filteredSubjects,
        ]);
    }
}
