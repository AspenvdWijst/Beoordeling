<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardStudentGrades extends Component
{
    public $grades;

    public function mount(){
        $student = Auth::user();
        $this->grades = $student->grades()->orderBy('updated_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.dashboard-student-grades');
    }
}
