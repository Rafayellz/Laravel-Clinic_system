<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Staff Profile</title>
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
        
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto 20px;
            display: block;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
        
        .btn-success:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
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
            <!-- <a class="nav-link active" href="{{ route('staff_profile') }}">
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
                <h4 class="mb-0">Staff Profile</h4>
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
                            <li><a class="dropdown-item active" href="{{ route('staff_profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <!-- <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-2"></i>Settings</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Profile Card -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Staff Profile</h4>
                        
                        <!-- Profile Picture -->
                        <div class="text-center mb-4">
                            <img src="https://ui-avatars.com/api/?name=Staff+User&background=28a745&color=fff&size=150" alt="Profile Picture" class="profile-picture">
                            <div class="mt-2">
                                <a href="#" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-camera me-1"></i> Change Photo
                                </a>
                            </div>
                        </div>
                        
                        <!-- Personal Information Section -->
                        <h5 class="mb-3 text-success">Personal Information</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" value="Staff User">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" value="staff.user@dnscclinics.com">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" value="+1 (555) 123-4567">
                            </div>
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department / Role</label>
                                <input type="text" class="form-control" id="department" value="Medical Staff" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="specialization" class="form-label">Specialization</label>
                                <select class="form-select" id="specialization">
                                    <option value="">Select Specialization</option>
                                    <option value="general">General Medicine</option>
                                    <option value="pediatrics">Pediatrics</option>
                                    <option value="cardiology">Cardiology</option>
                                    <option value="dermatology">Dermatology</option>
                                    <option value="orthopedics">Orthopedics</option>
                                    <option value="gynecology">Gynecology</option>
                                    <option value="neurology">Neurology</option>
                                    <option value="psychiatry">Psychiatry</option>
                                    <option value="dentistry">Dentistry</option>
                                    <option value="ophthalmology">Ophthalmology</option>
                                    <option value="ent">ENT (Ear, Nose, Throat)</option>
                                    <option value="nursing" selected>Nursing</option>
                                    <option value="pharmacy">Pharmacy</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Password Update Section -->
                        <h5 class="mb-3 mt-4 text-success">Update Password</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="staff-dashboard.html" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                            <button type="button" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>