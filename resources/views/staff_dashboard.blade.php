<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Staff Dashboard</title>
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
        
        .stat-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
        
        .appointment-status {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .status-item {
            text-align: center;
            flex: 1;
            padding: 10px;
        }
        
        .status-count {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .status-label {
            font-size: 14px;
            color: #6c757d;
        }
        
        .quick-actions .btn {
            margin: 5px;
            padding: 10px 15px;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-approved {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .badge-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
        }
        
        .welcome-card .card-body {
            display: flex;
            align-items: center;
        }
        
        .welcome-card .welcome-text {
            flex: 1;
        }
        
        .welcome-card .welcome-icon {
            font-size: 60px;
            opacity: 0.7;
        }
        
        .notes-section textarea {
            resize: none;
            min-height: 120px;
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
            <a class="nav-link active" href="{{ route('staff_dashboard') }}">
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
            <a class="nav-link" href="{{ route('staff_reports') }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reports</span>
            </a>
            <a class="nav-link" href="{{ route('staff_notifications') }}">
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
                <h4 class="mb-0">Staff Dashboard</h4>
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

        <!-- Welcome Card -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <div class="welcome-text">
                    <h3>Welcome back, Staff!</h3>
                    <p class="mb-0">Here's today's schedule and tasks.</p>
                </div>
                <div class="welcome-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
        </div>

        <!-- Dashboard Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--primary-green);">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-value">18</div>
                        <div class="stat-label">Patients Today</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: #ffc107;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-value">5</div>
                        <div class="stat-label">Pending Tasks</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <div class="stat-value">12</div>
                        <div class="stat-label">Medicines Given</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.1); color: #6c757d;">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value">32</div>
                        <div class="stat-label">Completed Tasks</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="quick-actions d-flex flex-wrap">
                    <a href="{{ route('staff_give_medicine') }}" class="btn btn-outline-success">
                        <i class="bi bi-capsule me-2"></i>Give Medicine
                    </a>
                    <a href="{{ route('staff_inventory_medicine') }}" class="btn btn-outline-success">
                        <i class="bi bi-capsule me-2"></i>Medicine Inventory
                    </a>
                    <a href="{{ route('staff_notifications') }}" class="btn btn-outline-success">
                        <i class="bi bi-bell me-2"></i>Notifications
                    </a>
                    <a href="{{ route('staff_reports') }}" class="btn btn-outline-success">
                        <i class="bi bi-bar-chart me-2"></i>Generate Report
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Today's Appointments -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Today's Appointments
                            <a href="#" class="btn btn-sm btn-outline-success">View All</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Time</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Smith</td>
                                        <td>10:30 AM</td>
                                        <td>Medical Checkup</td>
                                        <td><span class="badge badge-approved">Approved</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Maria Garcia</td>
                                        <td>11:15 AM</td>
                                        <td>Dental Consultation</td>
                                        <td><span class="badge badge-pending">Pending</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td>2:00 PM</td>
                                        <td>Vaccination</td>
                                        <td><span class="badge badge-approved">Approved</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Sarah Williams</td>
                                        <td>3:30 PM</td>
                                        <td>Eye Checkup</td>
                                        <td><span class="badge badge-completed">Completed</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Michael Brown</td>
                                        <td>4:15 PM</td>
                                        <td>Medical Checkup</td>
                                        <td><span class="badge badge-pending">Pending</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Log/Notes Section -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daily Notes</h5>
                        <div class="notes-section">
                            <textarea class="form-control" placeholder="Add your notes for today..."></textarea>
                            <div class="d-grid mt-2">
                                <button class="btn btn-success">Save Notes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Tasks</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Stock Medicine Inventory</h6>
                                    <small>Today</small>
                                </div>
                                <p class="mb-1">Check and restock common medicines.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Prepare Vaccination Supplies</h6>
                                    <small>Tomorrow</small>
                                </div>
                                <p class="mb-1">For the scheduled vaccination appointments.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Monthly Equipment Check</h6>
                                    <small>3 days</small>
                                </div>
                                <p class="mb-1">Inspect and maintain medical equipment.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>