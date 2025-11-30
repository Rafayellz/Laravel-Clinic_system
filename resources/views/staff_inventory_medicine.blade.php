<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Medicine Inventory</title>
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
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-normal {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .badge-expired {
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
        
        .action-buttons .btn {
            margin-right: 5px;
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
            <a class="nav-link  active" href="{{ route('staff_inventory_medicine') }}">
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
                <h4 class="mb-0">Medicine Inventory</h4>
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
                    <h3>Medicine Inventory Management</h3>
                    <p class="mb-0">Track and manage all medicines in stock.</p>
                </div>
                <div class="welcome-icon">
                    <i class="bi bi-capsule"></i>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Medicine Actions</h5>
                <div class="action-buttons d-flex flex-wrap">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Medicine
                    </button>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#updateStockModal">
                        <i class="bi bi-arrow-repeat me-2"></i>Update Stock
                    </button>
                </div>
            </div>
        </div>

        <!-- Medicine Inventory Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    Medicine Inventory
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control" placeholder="Search medicine...">
                        <button class="btn btn-outline-success" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </h5>
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
                                <td>125</td>
                                <td>2024-05-15</td>
                                <td><span class="badge badge-normal">Normal</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Amoxicillin 250mg</td>
                                <td>Antibiotic</td>
                                <td>42</td>
                                <td>2024-03-20</td>
                                <td><span class="badge badge-low">Low Stock</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Vitamin C 100mg</td>
                                <td>Supplement</td>
                                <td>89</td>
                                <td>2024-08-10</td>
                                <td><span class="badge badge-normal">Normal</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Ibuprofen 400mg</td>
                                <td>Pain Relief</td>
                                <td>15</td>
                                <td>2024-02-28</td>
                                <td><span class="badge badge-expired">Expired</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>005</td>
                                <td>Cetirizine 10mg</td>
                                <td>Allergy</td>
                                <td>67</td>
                                <td>2024-11-05</td>
                                <td><span class="badge badge-normal">Normal</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
                <nav aria-label="Medicine inventory pagination">
                    <ul class="pagination justify-content-center">
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
    </div>

    <!-- Add Medicine Modal -->
    <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMedicineModalLabel">Add New Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="medicineName" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="medicineName" required>
                        </div>
                        <div class="mb-3">
                            <label for="medicineCategory" class="form-label">Category</label>
                            <select class="form-select" id="medicineCategory" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="pain-relief">Pain Relief</option>
                                <option value="antibiotic">Antibiotic</option>
                                <option value="supplement">Supplement</option>
                                <option value="allergy">Allergy</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="initialStock" class="form-label">Initial Stock</label>
                            <input type="number" class="form-control" id="initialStock" required>
                        </div>
                        <div class="mb-3">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" id="expiryDate" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Add Medicine</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Stock Modal -->
    <div class="modal fade" id="updateStockModal" tabindex="-1" aria-labelledby="updateStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStockModalLabel">Update Medicine Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="selectMedicine" class="form-label">Select Medicine</label>
                            <select class="form-select" id="selectMedicine" required>
                                <option value="" selected disabled>Select Medicine</option>
                                <option value="paracetamol">Paracetamol 500mg</option>
                                <option value="amoxicillin">Amoxicillin 250mg</option>
                                <option value="vitamin-c">Vitamin C 100mg</option>
                                <option value="ibuprofen">Ibuprofen 400mg</option>
                                <option value="cetirizine">Cetirizine 10mg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stockChange" class="form-label">Stock Change</label>
                            <input type="number" class="form-control" id="stockChange" required>
                            <div class="form-text">Enter positive number to add stock, negative to remove.</div>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="reason" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Update Stock</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>