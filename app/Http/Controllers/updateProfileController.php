<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
class updateProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'institute' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'emergency_cont' => 'nullable|string|max:255',
        ]);
        
        $patient->update($validated);

        if($validated['email'] !== $user->email) {
         $user->update(['email' => $validated['email']]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('profile')->with('success', 'Password changed successfully!');
}
}