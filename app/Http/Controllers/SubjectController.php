<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function student(Subject $subject, User $student){
        $user=$student;
        $user->studentSubjects()->attach($subject->id);

        $assignmentIds = $subject->assignments()->pluck('id');
        $user->assignmentsStudents()->syncWithoutDetaching($assignmentIds);


//        Save this code to sync all students of the subject to a new assignment
//        $userIds = $subject->students()->pluck('id');
//        $assignment->students()->syncWithoutDetaching($userIds);

        return view('teacher.subject', compact('subject'));
    }
}
