<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(Subject $subject, Request $request){

        $assignment = new Assignment();
        $assignment->assignment_name = $request->assignment_name;
        $assignment->assignment_info = $request->assignment_info;
        $assignment->subject_id = $subject->id;
        $assignment->save();

        $userIds = $subject->students()->pluck('id');
        $assignment->students()->syncWithoutDetaching($userIds);

        return redirect()->route('teacher.subject', ['subject' => $subject->id])
            ->with('success', 'Assignment created successfully!');
    }

    public function update(Subject $subject, Assignment $assignment, Request $request){

        $assignment->assignment_name = $request->assignment_name;
        $assignment->assignment_info = $request->assignment_info;
        $assignment->update($request->all());
        $assignment->save();

        return redirect()->route('teacher.subject', ['subject' => $subject->id])
            ->with('success', 'Assignment updated successfully!');
    }
}
