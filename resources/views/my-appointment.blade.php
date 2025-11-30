<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - My Appointments</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        .appointment-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .badge-approved {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-rescheduled {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .appointment-card {
            transition: transform 0.2s;
        }
        .appointment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,.15);
        }
        .medicine-box {
            background-color: var(--light-green);
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        .medicine-item {
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .medicine-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .medicine-name {
            font-weight: 600;
            color: var(--dark-green);
        }
        .medicine-dosage {
            color: #666;
            font-size: 0.9rem;
        }
        .medicine-instructions {
            font-style: italic;
            color: #555;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 3rem;
            color: var(--primary-green);
            margin-bottom: 20px;
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
            <a class="navbar-brand" href="{{ route('dashboard') }}">
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
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background:none; border:none; cursor:pointer;">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
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
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookappointment') }}">
                                <i class="fas fa-calendar-plus"></i> Book Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('myappointment') }}">
                                <i class="fas fa-calendar-check"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('diagnosis') }}">
                                <i class="fas fa-file-medical"></i> Diagnosis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link" style="border:none; background:none; width:100%; text-align:left;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">My Appointments</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('bookappointment') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-calendar-plus me-2"></i>Book New Appointment
                        </a>
                    </div>
                </div>

                <!-- Success Message -->
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- View Toggle -->
                <div class="d-flex justify-content-end mb-3">
                    <div class="btn-group" role="group">
                        <a href="{{ route('myappointment') }}" class="btn btn-outline-success active">
                            <i class="fas fa-th-large me-2"></i>Card View
                        </a>
                        <a href="{{ route('myappointmenttable') }}" class="btn btn-outline-success">
                            <i class="fas fa-list me-2"></i>Table View
                        </a>
                    </div>
                </div>

                <!-- Empty State -->
                @if($UserBooking->isEmpty())
                    <div class="card">
                        <div class="card-body empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <h5 class="mt-3">No Appointments Yet</h5>
                            <p class="text-muted">You haven't booked any appointments. Click the button below to schedule one.</p>
                            <a href="{{ route('bookappointment') }}" class="btn btn-primary-custom mt-3">
                                <i class="fas fa-calendar-plus me-2"></i>Book Your First Appointment
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Appointments Cards -->
                    <div class="row">
                        @foreach($UserBooking as $booking)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card appointment-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="card-title">
                                                @if($booking->doctor)
                                                    {{ $booking->doctor }}
                                                @else
                                                    <span class="text-muted">Any Doctor</span>
                                                @endif
                                            </h5>
                                            <span class="appointment-badge badge-{{ $booking->status }}">
                                                @if($booking->status === 'pending')
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                @elseif($booking->status === 'approved')
                                                    <i class="fas fa-check-circle me-1"></i>Approved
                                                @elseif($booking->status === 'rejected')
                                                    <i class="fas fa-times-circle me-1"></i>Rejected
                                                @elseif($booking->status === 'rescheduled')
                                                    <i class="fas fa-sync me-1"></i>Rescheduled
                                                @endif
                                            </span>
                                        </div>

                                        <p class="card-text">
                                            <i class="fas fa-calendar-day me-2 text-muted"></i>{{ $booking->appointment_date->format('l, F j, Y') }}
                                        </p>
                                        <p class="card-text">
                                            <i class="far fa-clock me-2 text-muted"></i>{{ $booking->formatted_time }}
                                        </p>
                                        <p class="card-text">
                                            <i class="fas fa-stethoscope me-2 text-muted"></i>{{ $booking->service_name }}
                                        </p>
                                        <p class="card-text">
                                            <i class="fas fa-file-alt me-2 text-muted"></i><strong>Reason:</strong> {{ $booking->reason }}
                                        </p>

                                        <div class="d-grid gap-2 mt-4">
                                            @if($booking->status === 'pending' || $booking->status === 'rejected')
                                                <a href="{{ route('bookings.reschedule-form', $booking->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit me-2"></i> View Appointment
                                                </a>
                                            @elseif($booking->status === 'approved' || $booking->status === 'rescheduled')
                                                <button class="btn btn-outline-success" disabled>
                                                    <i class="fas fa-check-circle me-2"></i>Appointment Confirmed
                                                </button>
                                                <a href="{{ route('bookings.reschedule-form', $booking->id) }}" class="btn btn-outline-warning">
                                                    <i class="fas fa-sync me-2"></i>Reschedule
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
