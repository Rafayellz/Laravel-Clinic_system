<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Bookings;

class UserController extends Controller
{   

    public function login(){
        return view('login');
    }
     
    public function register(){
        return view('register');
    }

    //fetch user data for dashboard and all views that require user data
    public function userdata(){
        $user = Auth::user();
        return view('dashboard', compact('user')); 
    }

    

}
