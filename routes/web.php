<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClinicstaffController;
use App\Http\Controllers\updateProfileController;
use App\Http\Controllers\ValidateController;
<<<<<<< HEAD
use App\Http\Controllers\DoctorController;
=======
use App\Http\Controllers\MedicineController;

>>>>>>> ddc77aee7b4c18707f8711c213308079a7f2efc6

use Illuminate\Support\Facades\Auth;

// first to appear
Route::get('/', [UserController::class, 'login'])->name('home');

// User Authentication Routes
Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('register', [UserController::class, 'register'])->name('register');

// Validation Routes
Route::post('/registervalidate', [ValidateController::class, 'registervalidate'])->name('registervalidate');
Route::post('/loginvalidate', [ValidateController::class, 'loginvalidate'])->name('loginvalidate');

//update route
Route::put('/profile', [updateProfileController::class, 'updateProfile'])->name('update_profile');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [PatientController::class, 'userdata'])->name('dashboard');
Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
Route::get('/doctor_dashboard', [DoctorController::class, 'doctor_dashboard'])->name('doctor_dashboard');
Route::view('/staff_dashboard',  'Clinic Staff.staff_dashboard')->name('staff_dashboard');

//Patient Dashboard(Main routes) 
Route::get('/book_appointment', [BookingsController::class, 'book_appointment'])->name('book_appointment');
Route::get('/my_appointment', [BookingsController::class, 'my_appointment'])->name('my_appointment');
Route::get('/my_appointment_table', [BookingsController::class, 'my_appointment_table'])->name('my_appointmenttable');
Route::get('/diagnosis', [BookingsController::class, 'diagnosis'])->name('diagnosis');
Route::get('/profile', [BookingsController::class, 'profile'])->name('profile');
Route::get('/notifications', [BookingsController::class, 'notifications'])->name('notifications');

//change password route 
Route::post('/change-password', [updateProfileController::class, 'changePassword'])->name('change_password');

Route::resource('bookings', BookingsController::class);

// Bookings CRUD Routes
Route::post('/bookings', [BookingsController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/reschedule', [BookingsController::class, 'rescheduleForm'])->name('bookings.reschedule-form');
Route::put('/bookings/{booking}/reschedule', [BookingsController::class, 'reschedule'])->name('bookings.reschedule');

//Doctor Dashboard(Main routes)
Route::get('/doctor_manage_appointments', [DoctorController::class, 'doctor_manage_appointments'])->name('doctor_manage_appointments');
Route::get('/doctor_manage_users', [DoctorController::class, 'doctor_manage_users'])->name('doctor_manage_users');
Route::get('/doctor_medicine_inventory', [DoctorController::class, 'doctor_medicine_inventory'])->name('doctor_medicine_inventory');
Route::get('/doctor_add_medicine', [DoctorController::class, 'doctor_add_medicine'])->name('doctor_add_medicine');
Route::get('/doctor_reports', [DoctorController::class, 'doctor_reports'])->name('doctor_reports');
Route::get('/doctor_announcement', [DoctorController::class, 'doctor_announcement'])->name('doctor_announcement');
Route::get('/bookings/{booking}/doctor-reschedule-form', [DoctorController::class, 'doctor_reschedule_form'])->name('bookings.doctor_reschedule');
Route::put('/bookings/{booking}/doctor-reschedule', [DoctorController::class, 'doctor_reschedule'])->name('bookings.doctor_reschedule_update');

//Doctor Bookings Routes
Route::post('/bookings/{booking}/approve', [BookingsController::class, 'approve'])->name('bookings.approve');
Route::post('/bookings/{booking}/reject', [BookingsController::class, 'reject'])->name('bookings.reject');

//Staff  Clinic Dashboard(Main routes)
<<<<<<< HEAD
Route::get('/staff_give_medicine', [ClinicstaffController::class, 'staff_give_medicine'])->name('staff_give_medicine');
Route::get('/staff_inventory_medicine', [ClinicstaffController::class, 'staff_inventory_medicine'])->name('staff_inventory_medicine');
Route::get('/staff_profile', [ClinicstaffController::class, 'staff_profile'])->name('staff_profile');
Route::get('/staff_notifications', [ClinicstaffController::class, 'staff_notifications'])->name('staff_notifications');
Route::get('/staff_reports', [ClinicstaffController::class, 'staff_reports'])->name('staff_reports');
=======
//Route::get('/staff_give_medicine', [MedicineController::class, 'showGiveMedicineForm'])->name('staff_give_medicine');
//Route::get('/staff_inventory_medicine', [ClinicstaffController::class, 'staffinventorymedicine'])->name('staff_inventory_medicine');
Route::get('/staff_profile', [ClinicstaffController::class, 'staffprofile'])->name('staff_profile');
Route::get('/staff_notifications', [ClinicstaffController::class, 'staffnotifications'])->name('staff_notifications');
Route::get('/staff_reports', [ClinicstaffController::class, 'staffreports'])->name('staff_reports');
>>>>>>> ddc77aee7b4c18707f8711c213308079a7f2efc6

//Admin Dashboard(Main routes)
Route::get('/admin_manage_appointments', [AdminController::class, 'admin_manage_appointments'])->name('admin_manage_appointments');
Route::get('/admin_manage_users', [AdminController::class, 'admin_manage_users'])->name('admin_manage_users');
Route::get('/admin_medicine_inventory', [AdminController::class, 'admin_medicine_inventory'])->name('admin_medicine_inventory');
Route::get('/admin_add_medicine', [AdminController::class, 'admin_add_medicine'])->name('admin_add_medicine');
Route::get('/admin_reports', [AdminController::class, 'admin_reports'])->name('admin_reports');
Route::get('/admin_announcement', [AdminController::class, 'admin_announcement'])->name('admin_announcement');

//Admin manage users routes(adding, edit and deleting users)
Route::get('/admin_manage_users', [AdminController::class, 'admin_manage_users'])->name('admin_manage_users');
Route::post('/admin/users', [AdminController::class, 'store_user'])->name('admin.store_user');
Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
Route::delete('/patients/{patient}', [AdminController::class, 'destroyPatient'])->name('patients.destroy');
Route::put('/patients/{patient}', [AdminController::class, 'updatePatient'])->name('patients.update');

// Admin Bookings Routes
// Route::post('/bookings/{booking}/approve', [BookingsController::class, 'approve'])->name('bookings.approve');
// Route::post('/bookings/{booking}/reject', [BookingsController::class, 'reject'])->name('bookings.reject');

// Route::get('/bookings/{booking}/admin-reschedule-form', [AdminController::class, 'admin_reschedule_form'])->name('bookings.admin_reschedule');
// Route::put('/bookings/{booking}/admin-reschedule', [AdminController::class, 'admin_reschedule'])->name('bookings.admin_reschedule_update');

// (admin)User management routes
// Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
// Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
// Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
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
    return redirect('login');
})->name('logout');
