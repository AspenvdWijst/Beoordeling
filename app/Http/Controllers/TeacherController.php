<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function subject(Subject $subject){
        $assignments = $subject->assignments;

        return view('teacher.subject', compact('subject', 'assignments'));
    }

    public function assignment(Subject $subject, Assignment $assignment){
        return view('teacher.assignment', compact('subject', 'assignment'));
    }

    public function addAssignment(Subject $subject){
        return view('teacher.add-assignment', compact('subject'));
    }
}
