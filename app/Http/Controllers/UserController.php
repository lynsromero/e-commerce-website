<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::whereNot('role' , 1)->get();

        return view('users.list' , compact('users'));
    }
}
