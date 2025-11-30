<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Inventory - DNSC Clinic</title>
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
        
        .badge-low {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-medium {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-high {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-expired {
            background-color: #f8d7da;
            color: #721c24;
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
            <a class="nav-link active   " href="{{ route('admin_medicine_inventory') }}">  <!-- -->
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
                <h4 class="mb-0">Medicine Inventory</h4>
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

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Medicine Inventory</h2>
                <p class="text-muted mb-0">Manage all medicines in the clinic inventory</p>
            </div>
            <a href="{{ route('admin_add_medicine') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Add Medicine
            </a>
        </div>

        <!-- Medicine Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Medicine ID</th>
                                <th>Medicine Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Paracetamol 500mg</td>
                                <td>Pain Relief</td>
                                <td>45</td>
                                <td>2024-12-15</td>
                                <td><span class="badge badge-high">In Stock</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Amoxicillin 250mg</td>
                                <td>Antibiotic</td>
                                <td>12</td>
                                <td>2024-08-20</td>
                                <td><span class="badge badge-medium">Low Stock</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Ibuprofen 400mg</td>
                                <td>Pain Relief</td>
                                <td>28</td>
                                <td>2025-03-10</td>
                                <td><span class="badge badge-high">In Stock</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Vitamin C 1000mg</td>
                                <td>Supplement</td>
                                <td>5</td>
                                <td>2024-05-30</td>
                                <td><span class="badge badge-low">Critical</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>005</td>
                                <td>Cetirizine 10mg</td>
                                <td>Allergy</td>
                                <td>0</td>
                                <td>2024-11-05</td>
                                <td><span class="badge badge-low">Out of Stock</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>006</td>
                                <td>Omeprazole 20mg</td>
                                <td>Antacid</td>
                                <td>32</td>
                                <td>2023-12-01</td>
                                <td><span class="badge badge-expired">Expired</span></td>
                                <td>
                                    <a href="edit-medicine.html" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete-medicine.html" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Medicine inventory pagination">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Stock Summary -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-warning mb-2">
                            <i class="bi bi-exclamation-triangle fs-1"></i>
                        </div>
                        <h4 class="card-title">Low Stock</h4>
                        <p class="card-text fs-3">3</p>
                        <p class="card-text text-muted">Medicines need restocking</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-danger mb-2">
                            <i class="bi bi-x-circle fs-1"></i>
                        </div>
                        <h4 class="card-title">Out of Stock</h4>
                        <p class="card-text fs-3">1</p>
                        <p class="card-text text-muted">Medicines unavailable</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-danger mb-2">
                            <i class="bi bi-clock fs-1"></i>
                        </div>
                        <h4 class="card-title">Expired</h4>
                        <p class="card-text fs-3">1</p>
                        <p class="card-text text-muted">Medicines expired</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>