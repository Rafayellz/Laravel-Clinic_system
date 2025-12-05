<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

   <style>
        :root {
            --primary-green: #28a745;
            --light-green: #d4edda;
            --dark-green: #1e7e34;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--dark-green);
        }
        
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 5px rgba(0,0,0,.1);
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
            padding: 12px 24px;
            font-weight: 600;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        
        .notification-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .appointment-badge {
            background-color: var(--light-green);
            color: var(--dark-green);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light-green);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>

 <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC Logo" height="30" class="d-inline-block align-text-top me-2">
                DNSC Clinic Appointment System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">  
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>  {{ $user->first_name }} {{ $user->last_name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book_appointment') }}">
                                <i class="fas fa-calendar-plus"></i> Book Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my_appointment') }}">
                                <i class="fas fa-calendar-check"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('diagnosis') }}">
                                <i class="fas fa-file-medical"></i> Diagnosis
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer; padding: 12px 20px; color: #333; display: block; width: 100%; text-align: left;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
            </div>
        </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h4 class="mb-0"><i class="fas fa-sync me-2"></i>Reschedule Appointment</h4>
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
                                                    <option value="11:00" @selected(old('appointment_time', $booking->appointment_time) == '11:00')>11:00 AM</option>
                                                    <option value="11:30" @selected(old('appointment_time', $booking->appointment_time) == '11:30')>11:30 AM</option>
                                                    <option value="13:00" @selected(old('appointment_time', $booking->appointment_time) == '13:00')>1:00 PM</option>
                                                    <option value="13:30" @selected(old('appointment_time', $booking->appointment_time) == '13:30')>1:30 PM</option>
                                                    <option value="14:00" @selected(old('appointment_time', $booking->appointment_time) == '14:00')>2:00 PM</option>
                                                    <option value="14:30" @selected(old('appointment_time', $booking->appointment_time) == '14:30')>2:30 PM</option>
                                                    <option value="15:00" @selected(old('appointment_time', $booking->appointment_time) == '15:00')>3:00 PM</option>
                                                    <option value="15:30" @selected(old('appointment_time', $booking->appointment_time) == '15:30')>3:30 PM</option>
                                                    <option value="16:00" @selected(old('appointment_time', $booking->appointment_time) == '16:00')>4:00 PM</option>
                                                </select>
                                                @error('appointment_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2 mt-4">
                                            <a href="{{ Auth::user()->role === 'admin' ? route('doctor_manage_appointments') : route('my_appointment') }}" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary-custom">
                                                <i class="fas fa-save me-2"></i>Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
