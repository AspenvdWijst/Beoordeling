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

        if (auth()->user()->role_id === 2) {
            if (trim($this->search) !== '') {
                $users = User::where('name', 'like', '%' . $this->search . '%')
                    ->where('role_id', 1)
                    ->get();
            }
        }
        elseif (trim($this->search) !== '') {
            $users = User::where('name', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}
