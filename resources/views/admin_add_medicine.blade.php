<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine - DNSC Clinic</title>
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
            <a class="nav-link" href="{{ route('admin_reports') }}">  <!-- -->
                <i class="bi bi-bar-chart"></i> 
                <span>Reports</span>
            </a>
            <a class="nav-link active" href="{{ route('admin_medicine_inventory') }}">  <!-- -->
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <a class="nav-link" href="{{ route('admin_announcement') }}">  <!-- -->
                <i class="bi bi-megaphone"></i>
                <span>Announcements</span>
            </a>
            <a class="nav-link" href="index.html">   <!-- -->
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Add Medicine</h4>
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
                            <li><a class="dropdown-item" href="index.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Add Medicine Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Add New Medicine</h5>
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="medicineName" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="medicineName" placeholder="Enter medicine name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity / Stock</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" min="0" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="unit" class="form-label">Unit</label>
                            <select class="form-select" id="unit" required>
                                <option value="" selected disabled>Select unit</option>
                                <option value="tablets">Tablets</option>
                                <option value="bottles">Bottles</option>
                                <option value="packs">Packs</option>
                                <option value="syrups">Syrups</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" id="expiryDate" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Description / Notes (Optional)</label>
                        <textarea class="form-control" id="description" rows="4" placeholder="Enter any additional notes about this medicine"></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin_medicine_inventory') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-2"></i>Back to Inventory
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg me-2"></i>Save Medicine
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>