<?php

namespace App\Http\Controllers;

use App\Models\GradingForm;
use Illuminate\Support\Facades\Auth;

class GradingTemplateList extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 3) {
            $templates = GradingForm::all();
        } elseif ($user->role_id == 2) {
            $templates = GradingForm::whereHas('assignment.teachers', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get();
        } else {
            $templates = collect();
        }


        return view('grading-template-list', compact('templates'));
    }

    public function show($id)
    {
        $form = GradingForm::findOrFail($id);

        return view('grading-view', ['formId' => $id]);
    }
}
