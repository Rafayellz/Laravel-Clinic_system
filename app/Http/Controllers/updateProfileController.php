<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class updateProfileController extends Controller
{
    // public function updateProfile(Request $request){
    //     $user = Auth::user();
        
    //     $validated = $request->validate([
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'id_number' => 'required|string',
    //         'phone_number' => 'required|numeric',
    //         'institute' => 'required|string',
    //         'gender' => 'required|in:male,female,other,prefer_not_to_say',
    //         'height' => 'required|numeric',
    //         'weight' => 'required|numeric',
    //         'address' => 'required|string',
    //         'emergency_cont' => 'required|string',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //     ]);
        
    //     $user->update($validated);
        
    //     return response()->json(['success' => true, 'message' => 'Profile updated!']);
    // }
}
