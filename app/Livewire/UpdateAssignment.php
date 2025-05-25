<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\Subject;
use Livewire\Component;

class UpdateAssignment extends Component
{
    public Subject $subject;
    public Assignment $assignment;

    public function mount($subjectId, $assignmentId)
    {
        $this->subject = Subject::where('id', $subjectId)->first();
        $this->assignment = Assignment::where('id', $assignmentId)->first();
    }

    public function render(Subject $subject, Assignment $assignment)
    {
        return view('livewire.update-assignment', compact('subject', 'assignment'));
    }
}
