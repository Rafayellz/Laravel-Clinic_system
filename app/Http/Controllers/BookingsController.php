<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Patient;
class BookingsController extends Controller
{   
    //card view
    public function my_appointment(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();
        $UserBooking = Bookings::where('user_id', $user->id)->get();
        return view('Patient.my_appointment', compact('user', 'patient','UserBooking'));
    }

    //table view
    public function my_appointment_table(){
    $user = Auth::user();
    $patient = Patient::where('user_id', $user->id)->first();
    $UserBooking = Bookings::where('user_id', $user->id)->get();
    return view('Patient.my_appointment_table', compact('user', 'patient', 'UserBooking'));
    }

    public function book_appointment(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();
        return view('Patient.book_appointment', compact('user', 'patient'));
    }

    public function diagnosis(Request $request){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();
        // Medical history sa diagnosis page
        $bookings = Bookings::where('user_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        $now = Carbon::now();

        // Base query for medical history
        $query = Bookings::where('user_id', $user->id);

        $filter = $request->query('filter', 'all');
        $search = $request->query('search', '');

        switch($filter) {
            case 'this_year':
                $query->whereYear('appointment_date', $now->year);
                break;
            case 'last_6_months':
                $sixMonthsAgo = $now->copy()->subMonths(6);
                $query->where('appointment_date', '>=', $sixMonthsAgo->toDateString());
                break;
            case 'last_3_months':
                $threeMonthsAgo = $now->copy()->subMonths(3);
                $query->where('appointment_date', '>=', $threeMonthsAgo->toDateString());
                break;
            default: 
                break;
        }

        if($search) {
            $query->where(function($q) use ($search) {
                $q->where('reason', 'like', "%{$search}%")
                  ->orWhere('doctor', 'like', "%{$search}%")
                  ->orWhere('appointment_date', 'like', "%{$search}%");
            });
        }

        //filtered bookings
        $bookings = $query->orderBy('appointment_date', 'desc')->get();

        //calculate total records
        $totalRecords = Bookings::where('user_id', $user->id)->count();

        //calculate age
        $age = $user->date_of_birth 
            ? Carbon::parse($user->date_of_birth)->age 
            : null;

        return view('Patient.diagnosis', compact('user', 'patient','bookings', 'totalRecords', 'age', 'filter', 'search'));
    }

    public function profile(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        // (profile quick view) count upcoming appointments
        $upcomingCount = Bookings::where('user_id', $user->id)
            ->where('appointment_date', '>=', now()->format('Y-m-d'))
            ->where('status', '!=', 'approved')
            ->count();
        // (profile quick view) count completed appointments
        $completedCount = Bookings::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        return view('Patient.profile', compact('user', 'patient', 'upcomingCount', 'completedCount'));
    }

    public function notifications(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();
        return view('Patient.notifications', compact('user', 'patient'));
    }

    

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {   
        $UserBooking = Bookings::with('user')->get();
        return view('Doctor.doctor_manage-appointments', ['UserBooking' => $UserBooking]);
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
    public function store(Request $request){
        Log::info('=== BOOKING STORE METHOD CALLED ===');
        Log::info('Request data:', $request->all());
        Log::info('Authenticated user ID:', ['user_id' => Auth::id()]);

        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'doctor' => 'required|string',
            'service_type' => 'required|string',
            'reason' => 'required|string|max:500'
        ]);

        Log::info('Validation passed:', $validated);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Log::info('Final data to save:', $validated);

        try {
            $booking = Bookings::create($validated);
            Log::info('Booking created successfully:', ['booking_id' => $booking->id, 'booking' => $booking->toArray()]);
        } catch (\Exception $e) {
            Log::error('Error creating booking:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Error saving booking: ' . $e->getMessage());
        }

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
        
        // Use admin reschedule view if user is admin, otherwise patient view
        if ($user->role === 'admin') {
    return view('doctor.doctor_reschedule', compact('booking', 'user'));
}
        
        return view('Patient.reschedule', compact('booking', 'user'));
    }

    /**
     * Reschedule the appointment
     */
    public function reschedule(Request $request, Bookings $booking)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string'
        ]);

        $validated['status'] = 'rescheduled';
        $booking->update($validated);

        return redirect()->route('doctor.doctor_manage_appointments')->with('success', 'Appointment rescheduled successfully!');
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
