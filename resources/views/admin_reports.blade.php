<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Reports</title>
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
        
        .chart-placeholder {
            background-color: #f8f9fa;
            border-radius: 8px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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
            <a class="nav-link" href="{{ route('admin_dashboard') }}">  <!-- -->
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('admin_manage_appointments') }}">  <!-- -->
                <i class="bi bi-calendar-check"></i>
                <span>Manage Appointments</span>
            </a> 
            <a class="nav-link" href="{{ route('admin_manage_users') }}">  <!-- -->
                <i class="bi bi-people"></i>
                <span>Manage Users</span>
            </a>
            <a class="nav-link active" href="{{ route('admin_reports') }}">  <!-- -->
                <i class="bi bi-bar-chart"></i> 
                <span>Reports</span>
            </a>
            <a class="nav-link" href="{{ route('admin_medicine_inventory') }}">  <!-- -->
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <a class="nav-link" href="{{ route('admin_announcement') }}">  <!-- -->
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
                <h4 class="mb-0">Reports & Analytics</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-bell text-muted fs-5"></i>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=28a745&color=fff" alt="Admin" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-md-inline">Admin User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.html"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="login.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="reportType" class="form-label">Report Type</label>
                    <select class="form-select" id="reportType">
                        <option selected>Appointments Overview</option>
                        <option>Service Utilization</option>
                        <option>Patient Demographics</option>
                        <option>Revenue Reports</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="timePeriod" class="form-label">Time Period</label>
                    <select class="form-select" id="timePeriod">
                        <option selected>Last 7 Days</option>
                        <option>Last 30 Days</option>
                        <option>Last 3 Months</option>
                        <option>Last 6 Months</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate">
                </div>
                <div class="col-md-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <button class="btn btn-success me-2"><i class="bi bi-filter me-2"></i>Apply Filters</button>
                    <button class="btn btn-outline-success"><i class="bi bi-download me-2"></i>Export Report</button>
                </div>
            </div>
        </div>

        <!-- Charts Placeholder -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointments Trend</h5>
                        <div class="chart-placeholder">
                            <div class="text-center">
                                <i class="bi bi-bar-chart fs-1 text-muted"></i>
                                <p>Appointments Trend Chart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Service Distribution</h5>
                        <div class="chart-placeholder">
                            <div class="text-center">
                                <i class="bi bi-pie-chart fs-1 text-muted"></i>
                                <p>Service Distribution Chart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments per Week/Month Table -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Appointments per Week/Month
                            <a href="#" class="btn btn-sm btn-outline-success">Export Data</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>Total Appointments</th>
                                        <th>Approved</th>
                                        <th>Pending</th>
                                        <th>Cancelled</th>
                                        <th>Completion Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>This Week</td>
                                        <td>142</td>
                                        <td>118</td>
                                        <td>18</td>
                                        <td>6</td>
                                        <td>83.1%</td>
                                    </tr>
                                    <tr>
                                        <td>Last Week</td>
                                        <td>156</td>
                                        <td>132</td>
                                        <td>16</td>
                                        <td>8</td>
                                        <td>84.6%</td>
                                    </tr>
                                    <tr>
                                        <td>This Month</td>
                                        <td>568</td>
                                        <td>482</td>
                                        <td>62</td>
                                        <td>24</td>
                                        <td>84.9%</td>
                                    </tr>
                                    <tr>
                                        <td>Last Month</td>
                                        <td>612</td>
                                        <td>524</td>
                                        <td>68</td>
                                        <td>20</td>
                                        <td>85.6%</td>
                                    </tr>
                                    <tr>
                                        <td>This Quarter</td>
                                        <td>1,842</td>
                                        <td>1,584</td>
                                        <td>198</td>
                                        <td>60</td>
                                        <td>86.0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Common Reasons Table -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Most Common Consultation Reasons
                            <a href="#" class="btn btn-sm btn-outline-success">View Details</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Service/Reason</th>
                                        <th>Count</th>
                                        <th>Percentage</th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Medical Checkup</td>
                                        <td>324</td>
                                        <td>28.5%</td>
                                        <td><i class="bi bi-arrow-up text-success"></i> Increased</td>
                                    </tr>
                                    <tr>
                                        <td>Dental Consultation</td>
                                        <td>218</td>
                                        <td>19.2%</td>
                                        <td><i class="bi bi-arrow-up text-success"></i> Increased</td>
                                    </tr>
                                    <tr>
                                        <td>Vaccination</td>
                                        <td>187</td>
                                        <td>16.5%</td>
                                        <td><i class="bi bi-dash text-muted"></i> Stable</td>
                                    </tr>
                                    <tr>
                                        <td>Eye Checkup</td>
                                        <td>156</td>
                                        <td>13.7%</td>
                                        <td><i class="bi bi-arrow-down text-warning"></i> Decreased</td>
                                    </tr>
                                    <tr>
                                        <td>Flu/Cold Symptoms</td>
                                        <td>98</td>
                                        <td>8.6%</td>
                                        <td><i class="bi bi-arrow-up text-success"></i> Increased</td>
                                    </tr>
                                    <tr>
                                        <td>Skin Conditions</td>
                                        <td>72</td>
                                        <td>6.3%</td>
                                        <td><i class="bi bi-dash text-muted"></i> Stable</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td>79</td>
                                        <td>7.0%</td>
                                        <td><i class="bi bi-arrow-up text-success"></i> Increased</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Report Summary</h5>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Total Appointments</span>
                                <span>1,134</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Approval Rate</span>
                                <span>85.2%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 85.2%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Cancellation Rate</span>
                                <span>4.8%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 4.8%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Avg. Appointments/Day</span>
                                <span>37.8</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75.6%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Report Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
                                <i class="bi bi-file-earmark-text me-2"></i>Generate Custom Report
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-printer me-2"></i>Print Report
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-envelope me-2"></i>Email Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>