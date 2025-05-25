<?php

namespace App\Http\Controllers;

use App\Models\GradingForm;

class GradingTemplateList extends Controller
{
    public function index()
    {
        $templates = GradingForm::all();
        return view('grading-template-list', compact('templates'));
    }

    public function show($id)
    {
        // Optionally, you can check if the template exists:
        $form = GradingForm::findOrFail($id);

        // Pass the template ID to the blade view
        return view('grading-view', ['formId' => $id]);
    }
}
