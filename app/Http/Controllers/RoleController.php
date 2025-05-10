<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
       if(auth()->user()->role_id == 3){
           return view('admin.dashboard');
       }
       elseif(auth()->user()->role_id == 2){
           return view('teacher.dashboard');
       }
        else{
            return view('student.dashboard');
        }
    }
}
