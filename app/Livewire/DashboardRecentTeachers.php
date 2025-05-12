<?php

namespace App\Livewire;

use Livewire\Component;
use App\models\User;

class DashboardRecentTeachers extends Component
{
    public $recentTeachers;

    public function mount()
    {
        $this->recentTeachers = User::where('role_id', 2)
            ->latest()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard-recent-teachers');
    }
}
