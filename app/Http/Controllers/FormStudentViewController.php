<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\GradingResult;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use function Spatie\LaravelPdf\Support\pdf;

class FormStudentViewController extends Controller
{
    public function download($id)
    {
        $gradingResult = GradingResult::select(['id', 'student_id', 'form_data'])
            ->findOrFail($id);

        $form = $gradingResult->form_data;

        $cacheKey = "grade_{$form['assignment_id']}_{$gradingResult->student_id}_{$form['finalGrade']}";

        $grade = Cache::remember($cacheKey, 300, function () use ($form, $gradingResult) {
            return Grade::select(['id', 'grade', 'assignment_id', 'student_id'])
                ->where('assignment_id', $form['assignment_id'])
                ->where('student_id', $gradingResult->student_id)
                ->where('grade', $form['finalGrade'])
                ->first();
        });

        if (empty($form['tables']) || !is_array($form['tables'])) {
            return $this->generatePdf($form, $grade, 0, 0, 0);
        }

        $grandTotal = 0;
        $maxObtainablePoints = 0;
        $minObtainablePoints = 0;

        foreach ($form['tables'] as $table) {
            $maxObtainablePoints += $table['max_points'] ?? 0;
            $minObtainablePoints += $table['min_points'] ?? 0;

            if (!empty($table['criteria_rows']) && is_array($table['criteria_rows'])) {
                $rowPoints = array_column($table['criteria_rows'], 'points');
                $grandTotal += array_sum(array_filter($rowPoints, 'is_numeric'));
            }
        }

        return $this->generatePdf($form, $grade, $grandTotal, $maxObtainablePoints, $minObtainablePoints);
    }

    private function generatePdf($form, $grade, $grandTotal, $maxObtainablePoints, $minObtainablePoints)
    {
        return pdf()
            ->view('student.form-student-view', [
                'form' => $form,
                'grade' => $grade,
                'grandTotal' => $grandTotal,
                'maxObtainablePoints' => $maxObtainablePoints,
                'minObtainablePoints' => $minObtainablePoints,
            ])
            ->format('a4')
            ->landscape()
            ->name('beoordeling.pdf');
    }
}

