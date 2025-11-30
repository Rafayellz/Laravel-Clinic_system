<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinicstaff;

class ClinicstaffController extends Controller
{
    public function staffgivemedicine(){
        return view('staff_give_medicine');
    }
    public function staffinventorymedicine(){
        return view('staff_inventory_medicine');
    }
    public function staffprofile(){
        return view('staff_profile');
    }
    public function staffnotifications(){
        return view('staff_notifications');
    }
    public function staffreports(){
        return view('staff_reports');
    }
}
