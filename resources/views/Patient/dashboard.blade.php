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
                                <i class="fas fa-user-circle"></i>  {{ $patient->first_name }} {{ $patient->last_name}}
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('diagnosis') }}">
                                    <i class="fas fa-file-medical"></i> Diagnosis
                                </a>
                            </li>
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
                
                <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                    <!-- Welcome Message -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Welcome, {{ $patient->first_name }} {{ $patient->last_name}}</h1> <!-- dapat ma butang ang user name dria-->
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <a href="{{ route('book_appointment') }}" class="btn btn-primary-custom btn-lg">
                                <i class="fas fa-calendar-plus me-2"></i>Book Appointment 
                            </a> 
                        </div>
                    </div>

                    <!-- Cards Section -->
                    <div class="row">
                        <div class="row">
                        <!-- Next Appointment Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Next Appointment</h5>
                                </div>
                                <div class="card-body">
                                    @if($nextAppointment)
                                        <div class="appointment-info">
                                            <!-- Doctor Name -->
                                            <h6 class="mb-3">
                                                @if($nextAppointment->doctor)
                                                    <i class="fas fa-user-md me-2 text-success"></i>{{ $nextAppointment->doctor }}
                                                @else
                                                    <i class="fas fa-user-md me-2 text-success"></i>Any Available Doctor
                                                @endif
                                            </h6>
                                            
                                            <!-- Service Type -->
                                            <p class="mb-2">
                                                <i class="fas fa-stethoscope me-2 text-muted"></i>
                                                <strong>{{ $nextAppointment->service_name }}</strong>
                                            </p>
                                            
                                            <!-- Date -->
                                            <p class="mb-2">
                                                <i class="fas fa-calendar-day me-2 text-muted"></i>
                                                <strong>{{ $nextAppointment->appointment_date->format('l, F j, Y') }}</strong>
                                            </p>
                                            
                                            <!-- Time -->
                                            <p class="mb-2">
                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                <strong>{{ $nextAppointment->formatted_time }}</strong>
                                            </p>
                                            
                                            <!-- Reason -->
                                            <p class="mb-3">
                                                <i class="fas fa-file-alt me-2 text-muted"></i>
                                                <strong>Reason:</strong> {{ $nextAppointment->reason }}
                                            </p>
                                            
                                            <!-- Status Badge -->
                                            <p class="mb-3">
                                                @if($nextAppointment->status === 'pending')
                                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Pending</span>
                                                @elseif($nextAppointment->status === 'approved')
                                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Approved</span>
                                                @elseif($nextAppointment->status === 'rejected')
                                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Rejected</span>
                                                @elseif($nextAppointment->status === 'rescheduled')
                                                    <span class="badge bg-info"><i class="fas fa-sync me-1"></i>Rescheduled</span>
                                                @endif
                                            </p>
                                            
                                            <!-- Action Buttons -->
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('bookings.reschedule-form', $nextAppointment->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-eye me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-calendar-times text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-3">No upcoming appointments</p>
                                            <a href="{{ route('book_appointment') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-calendar-plus me-2"></i>Book Appointment
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Notifications Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-bell text-warning me-2"></i>
                                    Notifications
                                </div>
                                <div class="card-body">
                                    <div class="notification-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Appointment Reminder</h6>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                        <p class="mb-1">Your appointment with Dr. Santos is tomorrow at 10:30 AM.</p>
                                    </div>
                                    <div class="notification-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New Service Available</h6>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                        <p class="mb-1">Dental check-ups are now available at the clinic.</p>
                                    </div>
                                    <div class="notification-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Clinic Holiday</h6>
                                            <small class="text-muted">3 days ago</small>
                                        </div>
                                        <p class="mb-1">The clinic will be closed on March 20 for a local holiday.</p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('notifications') }}" class="btn btn-outline-primary btn-sm">View All Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Quick View Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-user text-info me-2"></i>
                                    Profile Quick View
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('https://via.placeholder.com/80') }}" alt="Profile" class="profile-img mb-3">
                                    <h5 class="card-title">{{ $patient->first_name }} {{ $patient->last_name}}</h5>
                                    <p class="card-text">Student ID: {{ $patient->id_number}}</p>
                                    <p class="card-text">
                                        <span class="appointment-badge me-2"> {{ $upcomingCount }} Upcoming</span>
                                        <span class="appointment-badge">{{ $completedCount }} Completed</span>
                                    </p>
                                    <div class="mt-3">
                                        <a href="{{ route('profile') }}" class="btn btn-outline-primary">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Appointments Table -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-history text-secondary me-2"></i>
                                    Recent Appointments
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Doctor</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($UserBooking->isEmpty())
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-4">
                                                            <i class="fas fa-inbox me-2"></i>No appointments found
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach($UserBooking->take(5) as $booking)
                                                        <tr>
                                                            <td>{{ $booking->appointment_date->format('M d, Y') }}</td>
                                                            <td>
                                                                @if($booking->doctor)
                                                                    {{ $booking->doctor }}
                                                                @else
                                                                    <span class="text-muted">Any Doctor</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $booking->service_name }}</td>
                                                            <td>
                                                                @if($booking->status === 'pending')
                                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                                @elseif($booking->status === 'approved')
                                                                    <span class="badge bg-success">Approved</span>
                                                                @elseif($booking->status === 'rejected')
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @elseif($booking->status === 'rescheduled')
                                                                    <span class="badge bg-info">Rescheduled</span>
                                                                @else
                                                                    <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('bookings.reschedule-form', $booking->id) }}" class="btn btn-sm btn-outline-primary">Details</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('my_appointment') }}" class="btn btn-primary-custom">View All Appointments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>