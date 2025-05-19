<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Component;

class SubjectAssignmentsOverview extends Component
{
    public function render(Subject $subject)
    {
        return view('livewire.subject-assignments-overview', compact('subject'));
    }
}
