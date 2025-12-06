<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Bookings;
use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{   
    public function doctor_dashboard(){
        // fetch recent appointments (limit sa 5)
        $recentAppointments = Bookings::with('user')
            ->orderBy('appointment_date', 'desc')
            ->limit(5)
            ->get();

        // get appointment status
        $pendingCount = Bookings::where('status', 'pending')->count();
        $approvedCount = Bookings::where('status', 'approved')->count();
        $cancelledCount = Bookings::where('status', 'rejected')->count();
        $totalAppointments = Bookings::count();

       return view('doctor.doctor_dashboard', compact('recentAppointments', 'pendingCount', 'approvedCount', 'cancelledCount', 'totalAppointments'));
    }

    public function doctor_manage_appointments(Request $request){
        $query = Bookings::with('user');

        // filter by date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        // filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // search by patient name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        $UserBooking = $query->orderBy('appointment_date', 'desc')->get();
    
        return view('doctor.doctor_manage_appointments', compact('UserBooking'));
    }
    
    public function doctor_medicine_inventory(){
        return view('doctor.doctor_medicine_inventory');
    }
    public function docotor_add_medicine(){
        return view('doctor.doctor_add_medicine');
    }
    public function doctor_reports(){
        return view('doctor.doctor_reports');
    }
     public function doctor_announcement(){
        return view('doctor.doctor_announcement');
    }


    // Doctor reschedule
    public function doctor_reschedule(Request $request, Bookings $booking)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string'
        ]);

        $validated['status'] = 'rescheduled';
        $booking->update($validated);

        return redirect()->route('doctor.doctor_manage_appointments')->with('success', 'Appointment rescheduled successfully!');
    }

   
}
