<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
       if(auth()->user()->role_id == 3){
           $grades = Grade::with('student', 'assignment')->get();
           return view('admin.dashboard')->with('grades', $grades);
       }
       elseif(auth()->user()->role_id == 2){
           return view('teacher.dashboard');
       }
        else{
            return view('student.dashboard');
        }
    }
}
