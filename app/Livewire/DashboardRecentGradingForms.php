<?php

namespace App\Livewire;

use App\Models\GradingResult;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardRecentGradingForms extends Component
{
    public function render()
    {
        $recentGradingForms = GradingResult::with(['gradingForm', 'student'])
            ->where('student_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard-recent-grading-forms', [
            'recentGradingForms' => $recentGradingForms,
        ]);
    }

    public function viewForm($formId)
    {
        $form = GradingForm::findOrFail($formId);

        return redirect()->route('student.grading-form.show', $form->grading_form_id);
    }
}
