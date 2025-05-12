<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
       if(auth()->user()->role_id == 3){
           $items = Item::all();
           return view('admin.dashboard', compact('items'));
       }
       elseif(auth()->user()->role_id == 2){
           return view('teacher.dashboard');
       }
        else{
            return view('student.dashboard');
        }
    }
}
