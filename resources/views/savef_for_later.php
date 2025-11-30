<!-- BookingController V1 -->
 <?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{   
    
    public function myappointment(){
        $user = Auth::user();
        $UserBooking = Bookings::all();
        return view('my-appointment', compact('user' , 'UserBooking'));
    }
    public function myappointmenttable(){
        $user = Auth::user();
        return view('my-appointment-table', compact('user'));
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
        $UserBooking = Bookings::all();
        return view('my-appointment', ['UserBooking' => $UserBooking]);
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

        Bookings::create($validated);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookings $bookings)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookings $bookings)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
