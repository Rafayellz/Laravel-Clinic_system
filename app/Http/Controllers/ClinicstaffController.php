<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinicstaff;

class ClinicstaffController extends Controller
{
    public function staff_give_medicine(){
        return view('Clinic Staff.staff_give_medicine');
    }
    public function staff_inventory_medicine(){
        return view('Clinic Staff.staff_inventory_medicine');
    }
    public function staff_profile(){
        return view('Clinic Staff.staff_profile');
    }
    public function staff_notifications(){
        return view('Clinic Staff.staff_notifications');
    }
    public function staff_reports(){
        return view('Clinic Staff.staff_reports');
    }
}
