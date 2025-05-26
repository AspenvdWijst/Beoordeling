<?php

namespace App\Http\Controllers;

use App\Models\GradingResult;

class FormStudentViewController extends Controller
{
    public function show($id)
    {
        // Fetch the grading result by ID
        $gradingResult = GradingResult::findOrFail($id);

        // Decode the JSON data (assuming column is named 'form_json')
        $form = $gradingResult->form_data;

        // Optionally, calculate grandTotal, maxObtainablePoints, minObtainablePoints
        $grandTotal = 0;
        $maxObtainablePoints = 0;
        $minObtainablePoints = 0;

        if (isset($form['tables']) && is_array($form['tables'])) {
            foreach ($form['tables'] as $table) {
                // Sum up points for grand total
                if (isset($table['criteria_rows']) && is_array($table['criteria_rows'])) {
                    foreach ($table['criteria_rows'] as $row) {
                        $grandTotal += $row['points'] ?? 0;
                    }
                }
                // Sum up max/min points if available
                $maxObtainablePoints += $table['max_points'] ?? 0;
                $minObtainablePoints += $table['min_points'] ?? 0;
            }
        }

        // Pass data to the student view
        return view('student.form-student-view', [
            'form' => $form,
            'grandTotal' => $grandTotal,
            'maxObtainablePoints' => $maxObtainablePoints,
            'minObtainablePoints' => $minObtainablePoints,
        ]);
    }
}
