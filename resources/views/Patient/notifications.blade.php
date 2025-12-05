<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - Notifications</title>
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
        
        .notification-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        
        .notification-announcement {
            color: #ffc107;
        }
        
        .notification-system {
            color: #17a2b8;
        }
        
        .notification-reminder {
            color: #28a745;
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
                            <i class="fas fa-user-circle"></i> {{ $patient->first_name }} {{ $patient->last_name}}
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
                            <a class="nav-link" href="{{ route('dashboard') }}">
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
                            <a class="nav-link active" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Notifications</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Mark All as Read</button>
                        </div>
                    </div>
                </div>

                <!-- Notifications List -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-bell text-warning me-2"></i>
                                All Notifications
                            </div>
                            <div class="card-body">
                                <!-- Notification 1 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-announcement">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New Dental Services Available</h6>
                                            <small class="text-muted">Today, 10:30 AM</small>
                                        </div>
                                        <p class="mb-1">We're excited to announce that dental check-ups and treatments are now available at the clinic. Book your appointment today!</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 2 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-system">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">System Maintenance</h6>
                                            <small class="text-muted">Yesterday, 3:45 PM</small>
                                        </div>
                                        <p class="mb-1">The appointment system will be temporarily unavailable on March 25 from 2:00 AM to 4:00 AM for scheduled maintenance.</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 3 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-reminder">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Appointment Reminder</h6>
                                            <small class="text-muted">March 14, 2023</small>
                                        </div>
                                        <p class="mb-1">Your appointment with Dr. Maria Santos is scheduled for tomorrow at 10:30 AM. Please arrive 15 minutes early.</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 4 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-announcement">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Clinic Holiday Announcement</h6>
                                            <small class="text-muted">March 10, 2023</small>
                                        </div>
                                        <p class="mb-1">The clinic will be closed on March 20 for a local holiday. Regular operations will resume on March 21.</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 5 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-system">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New Features Added</h6>
                                            <small class="text-muted">March 5, 2023</small>
                                        </div>
                                        <p class="mb-1">We've added new features to the appointment system, including appointment history and prescription tracking.</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 6 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-announcement">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New Doctor Joining</h6>
                                            <small class="text-muted">February 28, 2023</small>
                                        </div>
                                        <p class="mb-1">Dr. Robert Lim, our new dental specialist, is now accepting appointments. Welcome Dr. Lim to our team!</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 7 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-reminder">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Appointment Completed</h6>
                                            <small class="text-muted">February 20, 2023</small>
                                        </div>
                                        <p class="mb-1">Your dental check-up with Dr. Robert Lim has been completed. You can view your dental records in your profile.</p>
                                    </div>
                                </div>
                                
                                <!-- Notification 8 -->
                                <div class="notification-item d-flex">
                                    <div class="notification-icon notification-system">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Password Reset Required</h6>
                                            <small class="text-muted">February 15, 2023</small>
                                        </div>
                                        <p class="mb-1">For security purposes, please reset your password. This is a routine security measure.</p>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>