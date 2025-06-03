<?php

namespace App\Http\Controllers;

use App\Models\GradingResult;

class FormStudentViewController extends Controller
{
    public function show($id)
    {
        $gradingResult = GradingResult::findOrFail($id);

        $form = $gradingResult->form_data;

        $grandTotal = 0;
        $maxObtainablePoints = 0;
        $minObtainablePoints = 0;

        if (isset($form['tables']) && is_array($form['tables'])) {
            foreach ($form['tables'] as $table) {
                if (isset($table['criteria_rows']) && is_array($table['criteria_rows'])) {
                    foreach ($table['criteria_rows'] as $row) {
                        $grandTotal += $row['points'] ?? 0;
                    }
                }
                $maxObtainablePoints += $table['max_points'] ?? 0;
                $minObtainablePoints += $table['min_points'] ?? 0;
            }
        }

        return view('student.form-student-view', [
            'form' => $form,
            'grandTotal' => $grandTotal,
            'maxObtainablePoints' => $maxObtainablePoints,
            'minObtainablePoints' => $minObtainablePoints,
        ]);
    }
}
