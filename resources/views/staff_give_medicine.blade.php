<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Give Medicine</title>
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
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .btn-outline-secondary {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
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
            <a class="nav-link active" href="{{ route('staff_give_medicine') }}">
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
                <h4 class="mb-0">Prescription</h4>
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

        <!-- Page Content -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-success">Medicine Prescription Form</h4>
                        
                        <form>
                            <!-- Patient ID -->
                            <div class="mb-3">
                                <label for="studentName" class="form-label">Patient ID</label>
                                <input type="text" class="form-control" id="studentName" placeholder="Enter Patient ID" required>
                            </div>

                            <!-- Patient Name -->
                            <div class="mb-3">
                                <label for="studentName" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="studentName" placeholder="Enter Patient name" required>
                            </div>
                            
                            <!-- Appointment ID -->
                            <div class="mb-3">
                                <label for="appointmentId" class="form-label">Appointment ID</label>
                                <input type="text" class="form-control" id="appointmentId" placeholder="Enter Appointment ID" required>
                            </div>
                            
                            <!-- Select Medicine -->
                            <div class="mb-3">
                                <label for="medicine" class="form-label">Medicine ID</label>
                                <input type="text" class="form-control" name="medicine" id="medicineID" placeholder="Enter Medicine ID" required>
                            </div>

                            <!-- Quantity Given -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity Given</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="quantity" min="1" value="1" required>
                                    <span class="input-group-text">units</span>
                                </div>
                            </div>
                            
                            <!-- Notes / Prescription -->
                            <div class="mb-4">
                                <label for="notes" class="form-label">Notes / Prescription</label>
                                <textarea class="form-control" id="notes" rows="4" placeholder="Add any additional notes or prescription details"></textarea>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="staff-dashboard.html" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-2"></i>Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Recent Medicine Records -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Recent Medicine Records
                            <a href="#" class="btn btn-sm btn-outline-success">View All</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Smith</td>
                                        <td>Paracetamol</td>
                                        <td>2</td>
                                        <td>Today, 10:30 AM</td>
                                    </tr>
                                    <tr>
                                        <td>Maria Garcia</td>
                                        <td>Ibuprofen</td>
                                        <td>1</td>
                                        <td>Today, 11:15 AM</td>
                                    </tr>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td>Vitamin C</td>
                                        <td>1</td>
                                        <td>Yesterday, 2:00 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>