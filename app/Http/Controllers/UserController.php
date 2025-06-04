<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function add()
    {
        return view('users.add');
    }

    public function save(Request $request, User $user)
    {
        if ($user == Null) { $user = new User; }

        $user->role_id = (int)$request->role_id;
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = 'temp';

        $user->save();
        return redirect('/')->with('success', 'User saved');
    }

    public function update(User $user) {
        return view('users.update', compact('user'));
    }

    public function delete(User $user) {
        $user->delete();
        return redirect('/')->with('success', 'User has been deleted');
    }
}
