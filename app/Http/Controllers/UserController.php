<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Approval;
use function Psy\debug;

class UserController extends Controller
{
    public function add()
    {
        return view('users.add');
    }

    public function save(Request $request)
    {
        \Illuminate\Log\log("Saving user");

        $user = new User;

        $user->role_id = (int)$request->role_id;
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = 'temp'; // send email with automatically generated password

        $user->save();
        return redirect('/');
    }
}
