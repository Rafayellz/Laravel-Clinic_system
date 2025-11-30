<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bookings;
use Illuminate\Http\Request;

class AdminController extends Controller
{   
    //routes(web.php)
    public function admin_dashboard(){
        return view('admin_dashboard');
    }

    public function admin_manage_appointments(Request $request){
        $query = Bookings::with('user');

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by patient name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

    $UserBooking = $query->orderBy('appointment_date', 'desc')->get();
    
    return view('admin_manage_appointments', compact('UserBooking'));
}
    public function admin_manage_users(){
        return view('admin_manage_users');
    }
    public function admin_medicine_inventory(){
        return view('admin_medicine_inventory');
    }
    public function admin_add_medicine(){
        return view('admin_add_medicine');
    }
    public function admin_reports(){
        return view('admin_reports');
    }
     public function admin_announcement(){
        return view('admin_announcement');
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
    public function store(Request $request)
    {
        //
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
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
