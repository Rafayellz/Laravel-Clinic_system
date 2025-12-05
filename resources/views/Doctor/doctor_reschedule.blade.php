<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Reschedule Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #28a745;
            --light-green: #d4edda;
            --dark-green: #1e7e34;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 250px;
            z-index: 100;
        }
        
        .sidebar .logo {
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }
        
        .sidebar .logo img {
            max-height: 60px;
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 0;
            margin: 5px 10px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .card-header {
            background-color: var(--primary-green);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar .logo-text, .sidebar .nav-link span {
                display: none;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('img/DNSC_LOGO.png')}}" alt="DNSC Logo" class="img-fluid">
            <div class="logo-text mt-2 fw-bold text-success">DNSC Clinic</div>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link" href="{{ route('doctor_dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link active" href="{{ route('doctor_manage_appointments') }}">
                <i class="bi bi-calendar-check"></i>
                <span>Manage Appointments</span>
            </a> 
            <a class="nav-link" href="{{ route('doctor_manage_users') }}">
                <i class="bi bi-people"></i>
                <span>Manage Users</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_reports') }}">
                <i class="bi bi-bar-chart"></i> 
                <span>Reports</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_medicine_inventory') }}">
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_announcement') }}">
                <i class="bi bi-megaphone"></i>
                <span>Announcements</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link" style="border:none; background:none; width:100%; text-align:left; padding:var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x); cursor:pointer;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span> 
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Reschedule Appointment</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-bell text-muted fs-5"></i>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}&background=28a745&color=fff" alt="Admin" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background:none; border:none; cursor:pointer;">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Reschedule Form -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-arrow-repeat me-2"></i>Reschedule Appointment</h5>
                    </div>
                    <div class="card-body">
                        <!-- Current Appointment Details -->
                        <div class="mb-4">
                            <h6 class="mb-3"><strong>Current Appointment Details:</strong></h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Date:</strong> {{ $booking->appointment_date->format('M d, Y') }}</p>
                                    <p class="mb-2"><strong>Time:</strong> {{ $booking->formatted_time }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Service:</strong> {{ $booking->service_name }}</p>
                                    <p class="mb-0"><strong>Doctor:</strong> {{ $booking->doctor ?? 'Any Available' }}</p>
                                </div>
                            </div>
                            <hr class="my-3">
                            <p class="mb-0"><strong>Patient:</strong> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                            <p class="mb-0"><strong>Reason:</strong> {{ $booking->reason }}</p>
                        </div>

                        <!-- Reschedule Form -->
                        <form action="{{ route('bookings.reschedule', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="appointmentDate" class="form-label"><strong>New Date</strong></label>
                                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" 
                                        id="appointmentDate" name="appointment_date" 
                                        value="{{ old('appointment_date', $booking->appointment_date->format('Y-m-d')) }}" required>
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="appointmentTime" class="form-label"><strong>New Time</strong></label>
                                    <select class="form-select @error('appointment_time') is-invalid @enderror" 
                                            id="appointmentTime" name="appointment_time" required>
                                        <option value="" disabled>Choose a time</option>
                                        <option value="08:00" @selected(old('appointment_time', $booking->appointment_time) == '08:00')>8:00 AM</option>
                                        <option value="08:30" @selected(old('appointment_time', $booking->appointment_time) == '08:30')>8:30 AM</option>
                                        <option value="09:00" @selected(old('appointment_time', $booking->appointment_time) == '09:00')>9:00 AM</option>
                                        <option value="09:30" @selected(old('appointment_time', $booking->appointment_time) == '09:30')>9:30 AM</option>
                                        <option value="10:00" @selected(old('appointment_time', $booking->appointment_time) == '10:00')>10:00 AM</option>
                                        <option value="10:30" @selected(old('appointment_time', $booking->appointment_time) == '10:30')>10:30 AM</option>