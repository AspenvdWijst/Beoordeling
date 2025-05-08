<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearch extends Component
{
    public $search = '';

    public function render()
    {
        $users = [];

        // Only search when input is not empty or just spaces
        if (trim($this->search) !== '') {
            $users = User::where('email', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}
