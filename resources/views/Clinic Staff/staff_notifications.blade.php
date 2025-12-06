<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Notifications</title>
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
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-body {
            padding: 20px;
        }
        
        .notification-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-item.unread {
            background-color: rgba(40, 167, 69, 0.05);
            border-left: 4px solid var(--primary-green);
            padding-left: 16px;
        }
        
        .notification-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .notification-date {
            color: #6c757d;
            font-size: 14px;
        }
        
        .notification-message {
            color: #495057;
            margin-bottom: 10px;
        }
        
        .badge-unread {
            background-color: var(--primary-green);
            color: white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar .logo-text, .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link {
                text-align: center;
                margin: 5px;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 20px;
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
            <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC Logo" class="img-fluid">
            <div class="logo-text mt-2 fw-bold text-success">DNSC Clinic</div>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link" href="{{ route('staff_dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('staff_give_medicine') }}">
                <i class="bi bi-capsule"></i>
                <span>Give Medicine</span>
            </a>
            <a class="nav-link" href="{{ route('staff_inventory_medicine') }}">
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <!-- <a class="nav-link" href="{{ route('staff_profile') }}">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a> -->
            <a class="nav-link  " href="{{ route('staff_reports') }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reports</span>
            </a>
            <a class="nav-link active" href="{{ route('staff_notifications') }}">
                <i class="bi bi-bell"></i>
                <span>Notifications</span>
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
                <h4 class="mb-0">Notifications</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-bell text-muted fs-5"></i>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=Staff+User&background=28a745&color=fff" alt="Staff" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-md-inline">Staff User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('staff_profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <!-- <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-2"></i>Settings</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Notifications Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Announcements</h2>
            <div>
                <span class="badge bg-success">3 Unread</span>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="card">
            <div class="card-body">
                <div class="notification-list">
                    <!-- Unread Notification -->
                    <div class="notification-item unread">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">Clinic Holiday Schedule</div>
                                <div class="notification-message">The clinic will be closed on December 25th and 26th for Christmas holidays. Please inform patients accordingly.</div>
                                <div class="notification-date">Posted: December 10, 2023</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-success">Mark as Read</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Unread Notification -->
                    <div class="notification-item unread">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">New Health Alert: Flu Season</div>
                                <div class="notification-message">Increased cases of influenza reported in the area. Please ensure proper hygiene protocols and encourage flu vaccinations.</div>
                                <div class="notification-date">Posted: December 8, 2023</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-success">Mark as Read</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Unread Notification -->
                    <div class="notification-item unread">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">Updated Clinic Hours</div>
                                <div class="notification-message">Starting January 1st, clinic hours will extend to 7 PM on weekdays to accommodate more patients.</div>
                                <div class="notification-date">Posted: December 5, 2023</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-success">Mark as Read</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">New Medical Supplies Arrived</div>
                                <div class="notification-message">The latest shipment of medical supplies has arrived. Please check inventory and restock as needed.</div>
                                <div class="notification-date">Posted: December 1, 2023</div>
                            </div>
                            <div>
                                <span class="badge bg-secondary">Read</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">Staff Meeting Reminder</div>
                                <div class="notification-message">Monthly staff meeting scheduled for Friday at 3 PM in the conference room. All staff members are required to attend.</div>
                                <div class="notification-date">Posted: November 28, 2023</div>
                            </div>
                            <div>
                                <span class="badge bg-secondary">Read</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="notification-title">New Patient Portal Features</div>
                                <div class="notification-message">The patient portal has been updated with new features. Please familiarize yourself with the changes.</div>
                                <div class="notification-date">Posted: November 25, 2023</div>
                            </div>
                            <div>
                                <span class="badge bg-secondary">Read</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>