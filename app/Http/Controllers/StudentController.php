<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function subject(Subject $subject){
        return view('student.subject', compact('subject'));
    }
}
