<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Component;

class SubjectAssignmentsOverview extends Component
{
    public Subject $subject;

    public function mount($subjectId)
    {
        $this->subject = Subject::with('assignments')->findOrFail($subjectId);
    }

    public function render(Subject $subject)
    {
        return view('livewire.subject-assignments-overview', compact('subject'));
    }
}
