<?php

namespace App\Livewire;

use Livewire\Component;
use App\models\User;

class DashboardRecentStudents extends Component
{
    public $recentStudents;

    public function mount()
    {
        $this->recentStudents = User::where('role_id', 1)
            ->latest()
            ->take(10)
            ->get();
    }
    public function render()
    {
        return view('livewire.dashboard-recent-students');
    }
}
