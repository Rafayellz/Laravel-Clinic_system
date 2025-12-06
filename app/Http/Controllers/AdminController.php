<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bookings;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Staff;
class AdminController extends Controller
{   
    public function admin_dashboard(){
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

       return view('Admin.admin_dashboard', compact('recentAppointments', 'pendingCount', 'approvedCount', 'cancelledCount', 'totalAppointments'));
    }

    public function admin_manage_appointments(Request $request){
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
    
        return view('Admin.admin_manage_appointments', compact('UserBooking'));
    }

    public function admin_manage_users(){
    $users = User::where('role', '!=', 'patient')->paginate(10);
    $patients = Patient::with('user')->paginate(10);

    return view('Admin.admin_manage_users', compact('users', 'patients'));
    }  

    public function admin_medicine_inventory(){
        return view('Admin.admin_medicine_inventory');
    }

    public function admin_add_medicine(){
        return view('Admin.admin_add_medicine');
    }

    public function admin_reports(){
        return view('Admin.admin_reports');
    }

     public function admin_announcement(){
        return view('Admin.admin_announcement');
    }

    public function adminrescheduleform(Bookings $booking)
    {
        return view('admin.admin_reschedule', compact('booking'));
    }

    // Admin Reschedule Appointment
    public function admin_reschedule(Request $request, Bookings $booking)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string'
        ]);

        $validated['status'] = 'rescheduled';
        $booking->update($validated);

        return redirect()->route('admin_manage_appointments')->with('success', 'Appointment rescheduled successfully!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_user(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:doctor,staff,admin,patient',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'status' => 'active'
            ]);
        }

        if ($validated['role'] === 'staff') {
            Staff::create([
                'user_id' => $user->id,
                'status' => 'active'
            ]);
        }

        if ($validated['role'] === 'patient') {
            Patient::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin_manage_users')->with('success', 'User created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser(User $user) {
    return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePatient(Request $request, Patient $patient) {
    $validated = $request->validate([
        'email' => 'required|email|unique:patient,email,' . $patient->id,
        'password' => 'nullable|string|min:8',
    ]);

        $patient->email = $validated['email'];
        if ($validated['password']) {
            $patient->password = Hash::make($validated['password']);
        }
        $patient->save();

        return redirect()->route('admin_manage_users')->with('success', 'Patient updated successfully!');
        }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroyUser(User $user) {
        // Delete related doctor if exists
        if ($user->role === 'doctor') {
            Doctor::where('user_id', $user->id)->delete();
        }
        $user->delete();
        return redirect()->route('admin_manage_users')->with('success', 'User deleted successfully!');
    }

    public function destroyPatient(Patient $patient) {
        $user = $patient->user;
        $patient->delete();
        
        if ($user) {
            $user->delete();
        }
        
        return redirect()->route('admin_manage_users')->with('success', 'Patient deleted successfully!');
    }   
}
