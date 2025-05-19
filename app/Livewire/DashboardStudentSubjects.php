<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardStudentSubjects extends Component
{
    public $subjects;

    public function mount(){
        $student = Auth::user();
        $this->subjects = $student->subjects;
    }

    public function render()
    {
        return view('livewire.dashboard-student-subjects');
    }
}
