<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Staff Reports</title>
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
        
        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
        
        .btn-success:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        
        .btn-outline-success {
            color: var(--primary-green);
            border-color: var(--primary-green);
        }
        
        .btn-outline-success:hover {
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
            <a class="nav-link active" href="{{ route('staff_reports') }}">
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
                <h4 class="mb-0">Staff Reports</h4>
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

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daily Clinic Reports</h2>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReportModal">
                <i class="bi bi-plus-circle me-2"></i>Add Report
            </a>
        </div>

        <!-- Reports Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daily Reports</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Patients</th>
                                <th>Medicines Dispensed</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-10-15</td>
                                <td>24</td>
                                <td>18</td>
                                <td>Regular checkups and vaccinations</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-10-14</td>
                                <td>19</td>
                                <td>15</td>
                                <td>Mostly follow-up appointments</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-10-13</td>
                                <td>22</td>
                                <td>20</td>
                                <td>High demand for flu vaccines</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-10-12</td>
                                <td>17</td>
                                <td>12</td>
                                <td>Quiet day, routine appointments</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-10-11</td>
                                <td>28</td>
                                <td>25</td>
                                <td>Busy day with many walk-in patients</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Reports pagination">
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

    <!-- Add Report Modal -->
    <div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportModalLabel">Add Daily Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="reportDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="reportDate">
                        </div>
                        <div class="mb-3">
                            <label for="totalPatients" class="form-label">Total Patients</label>
                            <input type="number" class="form-control" id="totalPatients" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="medicinesDispensed" class="form-label">Medicines Dispensed</label>
                            <input type="number" class="form-control" id="medicinesDispensed" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="reportNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="reportNotes" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Save Report</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDetailsModalLabel">Report Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Date:</div>
                        <div class="col-sm-8">2023-10-15</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Total Patients:</div>
                        <div class="col-sm-8">24</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Medicines Dispensed:</div>
                        <div class="col-sm-8">18</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Notes:</div>
                        <div class="col-sm-8">Regular checkups and vaccinations. High demand for flu vaccines. No major incidents reported.</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Staff on Duty:</div>
                        <div class="col-sm-8">Dr. Smith, Nurse Johnson</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>