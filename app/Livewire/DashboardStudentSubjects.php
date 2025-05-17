<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardStudentSubjects extends Component
{
    public $grades;

    public function mount(){

        $student=Auth::user();
        $this->grades = $student->grades;

    }

    public function render()
    {
        return view('livewire.dashboard-student-subjects');
    }
}
