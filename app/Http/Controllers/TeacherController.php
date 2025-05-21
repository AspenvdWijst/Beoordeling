<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Assignment;

class TeacherController extends Controller
{
    public function subject(Subject $subject){
        $assignments = $subject->assignments;

        return view('teacher.subject', compact('subject', 'assignments'));
    }

    public function assignment(Subject $subject, Assignment $assignment){
        return view('teacher.assignment', compact('subject', 'assignment'));
    }
}
