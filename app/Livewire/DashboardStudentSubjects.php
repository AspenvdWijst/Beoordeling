<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardStudentSubjects extends Component
{
    public $studentSubjects;

    public function mount(){

        $student=Auth::user();
        $this->studentSubjects = $student->grades;
    }

    public function render()
    {
        return view('livewire.dashboard-student-subjects');
    }
}
