<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookings;


class PatientController extends Controller
{
    public function userdata(){
        $user = Auth::user();
    
        //(dashboard)->fetch the latest upcoming appointment
        $nextAppointment = Bookings::where('user_id', $user->id)
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->first();

        //(dashboard)->fetch all user bookings for recent appointments table
        $UserBooking = Bookings::where('user_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->get();
        
        return view('dashboard', compact('user', 'nextAppointment', 'UserBooking'));
    }

}
