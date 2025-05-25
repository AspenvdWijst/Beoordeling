<?php

namespace App\Livewire;

use App\Models\Subject;
use App\Models\User;
use Livewire\Component;

class AddStudentToSubject extends Component
{
    public $search = '';
    public Subject $subject;

    public function mount($subjectId){
        $this->subject = Subject::findOrFail($subjectId);
    }

    public function render(Subject $subject)
    {
        $users = [];

        if (trim($this->search) !== '') {
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->where('role_id', 1)
                ->get();
        }

        return view('livewire.add-student-to-subject', [
            'users' => $users,
        ], compact('subject'));
    }
}
