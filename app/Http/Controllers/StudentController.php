<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class StudentController extends Controller
{
    public function subject(Subject $subject){
        $assignments = $subject->assignments;

        return view('student.subject', compact('subject', 'assignments'));
    }

    public function download(Subject $subject,Assignment $assignment){
        $pdf = Pdf::loadView('student.dashboard', [$subject, $assignment]);
        return $pdf->download('invoice.pdf', ['Attachment' => false]);
    }
}
