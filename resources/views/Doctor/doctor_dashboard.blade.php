<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Admin Dashboard</title>
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
            <img src="{{ asset('img/DNSC_LOGO.png')}}" alt="DNSC Logo" class="img-fluid">
            <div class="logo-text mt-2 fw-bold text-success">DNSC Clinic</div>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link active" href="{{ route('doctor_dashboard') }}">  <!-- -->
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_manage_appointments') }}">  <!-- -->
                <i class="bi bi-calendar-check"></i>
                <span>Manage Appointments</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_reports') }}">  <!-- -->
                <i class="bi bi-bar-chart"></i>     
                <span>Reports</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_medicine_inventory') }}">  <!-- -->
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <a class="nav-link" href="{{ route('doctor_announcement') }}">  <!-- -->
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
                <h4 class="mb-0">Doctor Dashboard</h4>
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

        <!-- Welcome Card -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <div class="welcome-text">
                    <h3>Welcome back, Doctor!</h3>
                    <p class="mb-0">Here's what's happening with your clinic today.</p>
                </div>
                <div class="welcome-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
        </div>

       <!-- Appointment Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--primary-green);">
                            <i class="bi bi-calendar-day"></i>
                        </div>
                        <div class="stat-value">{{ $totalAppointments }}<span class="text-muted" style="font-size: 18px;">/50</span></div>
                        <div class="stat-label">Total Appointments Today</div>
                        <div class="progress mt-2" style="height: 6px; width: 100%;">
                            @php $percentage = min(($totalAppointments / 50) * 100, 100); @endphp
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                        <small class="text-muted mt-1">{{ 50 - $totalAppointments }} slots remaining</small>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointment Status</h5>
                        <div class="appointment-status">
                            <div class="status-item">
                                <div class="status-count text-warning">{{ $pendingCount }}</div>
                                <div class="status-label">Pending</div>
                            </div>
                            <div class="status-item">
                                <div class="status-count text-success">{{ $approvedCount }}</div>
                                <div class="status-label">Approved</div>
                            </div>
                            <div class="status-item">
                                <div class="status-count text-danger">{{ $cancelledCount }}</div>
                                <div class="status-label">Cancelled</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="quick-actions d-flex flex-wrap">
                    <a href="{{ route('doctor_announcement') }}" class="btn btn btn-outline-success">
                        <i class="bi bi-megaphone me-2"></i>Add Announcement
                    </a>
                    <a href="{{ route('doctor_add_medicine') }}" class="btn btn-outline-success">
                        <i class="bi bi-capsule me-2"></i>Add Medicine
                    </a>
                    <a href="{{ route('doctor_manage_appointments') }}" class="btn btn-outline-success">
                        <i class="bi bi-calendar-check me-2"></i>Manage Appointments
                    </a>
                    <a href="{{ route('doctor_reports') }}" class="btn btn-outline-success">
                        <i class="bi bi-bar-chart me-2"></i>Generate Report
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Recent Appointments
                            <a href="{{ route('doctor_manage_appointments') }}" class="btn btn-sm btn-outline-success">View All</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Date & Time</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentAppointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}</td>
                                            <td>{{ $appointment->appointment_date->format('M d, Y') }}, {{ $appointment->formatted_time }}</td>
                                            <td>{{ $appointment->service_name }}</td>
                                            <td>
                                                @if($appointment->status === 'pending')
                                                    <span class="badge badge-pending">Pending</span>
                                                @elseif($appointment->status === 'approved')
                                                    <span class="badge badge-approved">Approved</span>
                                                @elseif($appointment->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-info">{{ ucfirst($appointment->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No appointments found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- System Status -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">System Status</h5>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Appointments Today</span>
                                <span>24/50</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 48%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Medicine Stock</span>
                                <span>65%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>System Uptime</span>
                                <span>99.8%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 99.8%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Announcements -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Recent Announcements
                            <a href="{{ route('doctor_announcement') }}" class="btn btn-sm btn-outline-success">View All</a>
                        </h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Flu Vaccination Campaign</h6>
                                    <small>2 days ago</small>
                                </div>
                                <p class="mb-1">Annual flu vaccination is now available for all students and staff.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Clinic Hours Update</h6>
                                    <small>5 days ago</small>
                                </div>
                                <p class="mb-1">The clinic will close early on Friday for staff training.</p>
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