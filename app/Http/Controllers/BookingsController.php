<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{   
    //card view
    public function myappointment(){
        $user = Auth::user();
        $UserBooking = Bookings::where('user_id', $user->id)->get();
        return view('my-appointment', compact('user', 'UserBooking'));
    }

    //table view
    public function myappointmenttable(){
    $user = Auth::user();
    $UserBooking = Bookings::where('user_id', $user->id)->get();
    return view('my-appointment-table', compact('user', 'UserBooking'));
    }

    public function bookappointment(){
        $user = Auth::user();
        return view('book-appointment', compact('user'));
    }

    public function diagnosis(){
        $user = Auth::user();
        return view('diagnosis', compact('user'));
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function notifications(){
        $user = Auth::user();
        return view('notifications', compact('user'));
    }

    

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {   
        $UserBooking = Bookings::with('user')->get();
        return view('admin.manage-appointments', ['UserBooking' => $UserBooking]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        // $SaveBooking = Bookings::all();
        // return view('book-appointment', ['SaveBooking' => $SaveBooking]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'doctor' => 'nullable|string',
            'service_type' => 'required|string',
            'reason' => 'required|string|max:500'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        Bookings::create($validated);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    /**
     * Update the appointment status (Approve)
     */
    public function approve(Bookings $booking)
    {
        $booking->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }


    /**
     * Update the appointment status (Reject)
     */
    public function reject(Bookings $booking)
    {
        $booking->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Appointment rejected successfully!');
    }


    /**
     * Show the form for rescheduling an appointment
     */
    public function rescheduleForm(Bookings $booking)
    {
        $user = Auth::user();
        return view('reschedule', compact('booking', 'user'));
    }


    /**
     * Update the appointment with new date and time
     */
    public function reschedule(Request $request, Bookings $booking)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string'
        ]);

        $validated['status'] = 'rescheduled';
        $booking->update($validated);

        return redirect()->route('admin.manage-appointments')->with('success', 'Appointment rescheduled successfully!');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully!');
    }
}
