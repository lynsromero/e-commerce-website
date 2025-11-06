<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
 
            return redirect()->route('dashboard');
        }
 
        return back()->with('error' , 'Crediential Not Matched');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
