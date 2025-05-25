<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subject;

class NewAssignment extends Component
{
    public Subject $subject;

    public function mount($subjectId)
    {
        $this->subject = Subject::where('id', $subjectId)->first();
    }

    public function render(Subject $subject)
    {
        return view('livewire.new-assignment', compact('subject'));
    }
}
