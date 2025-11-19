<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if(!Auth::user()){
            return redirect()->route('user.login');
        }
        $user = Auth::user();
        return view('user-panel.profile' , compact('user'));
    }
}
