<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;


class StudentController extends Controller
{
    public function subject(Subject $subject){
        $assignments = $subject->assignments;

        return view('student.subject', compact('subject', 'assignments'));
    }

    public function download(Subject $subject,Assignment $assignment){
        return pdf()
            ->view('student.dashboard', compact('subject', 'assignment'))
            ->landscape()
            ->name('invoice-2023-04-10.pdf');
    }



}
