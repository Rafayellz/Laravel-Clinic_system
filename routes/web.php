<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClinicstaffController;
use App\Http\Controllers\updateProfileController;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\MedicineController;


use Illuminate\Support\Facades\Auth;

// first to appear
Route::get('/', [UserController::class, 'login1'])->name('home');

//test
Route::get('test_login', [UserController::class, 'login1'])->name('test_login');
Route::get('test_register', [UserController::class, 'register1'])->name('test_register');

// User Authentication Routes
// Route::get('/login', [UserController::class, 'login'])->name('login');
// Route::get('/register', [UserController::class, 'register'])->name('register');

// Validation Routes
Route::post('/registervalidate', [ValidateController::class, 'registervalidate'])->name('registervalidate');
Route::post('/loginvalidate', [ValidateController::class, 'loginvalidate'])->name('loginvalidate');

//update route
Route::put('/profile', [updateProfileController::class, 'updateProfile'])->name('update_profile');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [PatientController::class, 'userdata'])->name('dashboard');
Route::view('/admin_dashboard', 'admin_dashboard')->name('admin_dashboard');
Route::view('/staff_dashboard',  'staff_dashboard')->name('staff_dashboard');

//Patient Dashboard(Main routes) 
Route::get('/book-appointment', [BookingsController::class, 'bookappointment'])->name('bookappointment');
Route::get('/my-appointment', [BookingsController::class, 'myappointment'])->name('myappointment');
Route::get('/my-appointment-table', [BookingsController::class, 'myappointmenttable'])->name('myappointmenttable');
Route::get('/diagnosis', [BookingsController::class, 'diagnosis'])->name('diagnosis');
Route::get('/profile', [BookingsController::class, 'profile'])->name('profile');
Route::get('/notifications', [BookingsController::class, 'notifications'])->name('notifications');

Route::resource('bookings', BookingsController::class);

// Bookings CRUD Routes
Route::post('/bookings', [BookingsController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/reschedule', [BookingsController::class, 'rescheduleForm'])->name('bookings.reschedule-form');
Route::put('/bookings/{booking}/reschedule', [BookingsController::class, 'reschedule'])->name('bookings.reschedule');

//Staff  Clinic Dashboard(Main routes)
//Route::get('/staff_give_medicine', [MedicineController::class, 'showGiveMedicineForm'])->name('staff_give_medicine');
//Route::get('/staff_inventory_medicine', [ClinicstaffController::class, 'staffinventorymedicine'])->name('staff_inventory_medicine');
Route::get('/staff_profile', [ClinicstaffController::class, 'staffprofile'])->name('staff_profile');
Route::get('/staff_notifications', [ClinicstaffController::class, 'staffnotifications'])->name('staff_notifications');
Route::get('/staff_reports', [ClinicstaffController::class, 'staffreports'])->name('staff_reports');

//Admin Dashboard(Main routes)
Route::get('/admin_manage_appointments', [AdminController::class, 'admin_manage_appointments'])->name('admin_manage_appointments');
Route::get('/admin_manage_users', [AdminController::class, 'admin_manage_users'])->name('admin_manage_users');
Route::get('/admin_medicine_inventory', [AdminController::class, 'admin_medicine_inventory'])->name('admin_medicine_inventory');
Route::get('/admin_add_medicine', [AdminController::class, 'admin_add_medicine'])->name('admin_add_medicine');
Route::get('/admin_reports', [AdminController::class, 'admin_reports'])->name('admin_reports');
Route::get('/admin_announcement', [AdminController::class, 'admin_announcement'])->name('admin_announcement');

// Admin Bookings Routes
Route::post('/bookings/{booking}/approve', [BookingsController::class, 'approve'])->name('bookings.approve');
Route::post('/bookings/{booking}/reject', [BookingsController::class, 'reject'])->name('bookings.reject');

});


//Medicine Inventory Route
Route::middleware(['auth'])->group(function(){
     // Display inventory
    Route::get('/staff/inventory-medicine', [MedicineController::class, 'index'])
        ->name('staff_inventory_medicine');
    
    // Add medicine
    Route::post('/staff/inventory-medicine', [MedicineController::class, 'store'])
        ->name('medicine.store');

    // Show edit form
    Route::get('/staff/inventory-medicine/{medicine}/edit', [MedicineController::class, 'edit'])
    ->name('medicine.edit');
    
    // Update medicine
    Route::put('/staff/inventory-medicine/{medicine}', [MedicineController::class, 'update'])
        ->name('medicine.update');
    
    // Update stock
    Route::post('/staff/inventory-medicine/update-stock', [MedicineController::class, 'updateStock'])
        ->name('medicine.updateStock');
    
    // Delete medicine
    Route::delete('/staff/inventory-medicine/{medicine}', [MedicineController::class, 'destroy'])
        ->name('medicine.destroy');
});

// Give Medicine Routes
Route::middleware(['auth'])->group(function () {
    // Show give medicine form (GET)
    Route::get('/staff_give_medicine', [MedicineController::class, 'showGiveMedicineForm'])
        ->name('staff_give_medicine');
    
    // Process giving medicine (POST)
    Route::post('/staff_give_medicine', [MedicineController::class, 'giveMedicine'])
        ->name('medicine.give');
});


// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('test_login');
})->name('logout');
