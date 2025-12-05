<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookings;
use App\Models\Patient;

class PatientController extends Controller
{
    public function userdata(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        //if patient doesn't exist
        if (!$patient) {
            return redirect()->route('login')->with('error', 'Patient record not found');
        }

        //(dashboard)->fetch the latest upcoming appointment
        $nextAppointment = Bookings::where('user_id', $user->id)
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->first();

        //(dashboard)->fetch all user bookings for recent appointments table
        $UserBooking = Bookings::where('user_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->get();
        
        // (profile quick view) count upcoming appointments
        $upcomingCount = Bookings::where('user_id', $user->id)
            ->where('appointment_date', '>=', now()->format('Y-m-d'))
            ->where('status', '!=', 'approved')
            ->count();
        // (profile quick view) count completed appointments
        $completedCount = Bookings::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        return view('Patient.dashboard', compact('user', 'patient','nextAppointment', 'UserBooking','upcomingCount', 'completedCount'));
    }

}
