<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .medicine-info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            display: none;
        }

        .medicine-info-box.show {
            display: block;
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
            <a class="nav-link active" href="{{ route('staff_give_medicine') }}">
                <i class="bi bi-capsule"></i>
                <span>Give Medicine</span>
            </a>
            <a class="nav-link" href="{{ route('staff_inventory_medicine') }}">
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
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
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Staff User' }}&background=28a745&color=fff" alt="Staff" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'Staff User' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('staff_profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-success">Medicine Prescription Form</h4>
                        
                        <form action="{{ route('staff_give_medicine') }}" method="POST">
                            @csrf
                            
                            <!-- Patient ID -->
                            <div class="mb-3">
                                <label for="patientId" class="form-label">Patient ID <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('patient_id') is-invalid @enderror" 
                                       id="patientId" 
                                       name="patient_id"
                                       value="{{ old('patient_id') }}"
                                       placeholder="Enter Patient ID" 
                                       required>
                                @error('patient_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Patient Name -->
                            <div class="mb-3">
                                <label for="patientName" class="form-label">Patient Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('patient_name') is-invalid @enderror" 
                                       id="patientName" 
                                       name="patient_name"
                                       value="{{ old('patient_name') }}"
                                       placeholder="Enter Patient name" 
                                       required>
                                @error('patient_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Appointment ID -->
                            <div class="mb-3">
                                <label for="appointmentId" class="form-label">Appointment ID (Optional)</label>
                                <input type="text" 
                                       class="form-control @error('appointment_id') is-invalid @enderror" 
                                       id="appointmentId" 
                                       name="appointment_id"
                                       value="{{ old('appointment_id') }}"
                                       placeholder="Enter Appointment ID">
                                @error('appointment_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Select Medicine -->
                            <div class="mb-3">
                                <label for="medicine" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                                <select class="form-select @error('medicine_id') is-invalid @enderror" 
                                        id="medicine" 
                                        name="medicine_id" 
                                        required>
                                    <option value="" selected disabled>Select Medicine</option>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}" 
                                                data-stock="{{ $medicine->stock }}"
                                                data-category="{{ $medicine->category }}"
                                                data-expiry="{{ date('Y-m-d', strtotime($medicine->expiry_date)) }}"
                                                {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                                            {{ $medicine->name }} (Stock: {{ $medicine->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('medicine_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Medicine Info Box -->
                                <div class="medicine-info-box" id="medicineInfo">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Category:</strong>
                                            <p id="medicineCategory" class="mb-0">-</p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Available Stock:</strong>
                                            <p id="medicineStock" class="mb-0 text-success">-</p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Expiry Date:</strong>
                                            <p id="medicineExpiry" class="mb-0">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity Given -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity Given <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" 
                                           class="form-control @error('quantity') is-invalid @enderror" 
                                           id="quantity" 
                                           name="quantity"
                                           min="1" 
                                           value="{{ old('quantity', 1) }}" 
                                           required>
                                    <span class="input-group-text">units</span>
                                </div>
                                @error('quantity')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Notes / Prescription -->
                            <div class="mb-4">
                                <label for="notes" class="form-label">Notes / Prescription</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" 
                                          name="notes"
                                          rows="4" 
                                          placeholder="Add any additional notes or prescription details">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('staff_dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-2"></i>Dispense Medicine
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Recent Prescriptions -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Recent Prescriptions
                            <span class="badge bg-success">{{ $recentRecords->count() }} prescriptions</span>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th>Given By</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentRecords as $record)
                                    <tr>
                                        <td>
                                            <strong>{{ $record->patient_name }}</strong><br>
                                            <small class="text-muted">ID: {{ $record->patient_id }}</small>
                                        </td>
                                        <td>{{ $record->medicine->name }}</td>
                                        <td>{{ $record->quantity }} units</td>
                                        <td>{{ $record->givenBy->name ?? 'N/A' }}</td>
                                        <td>{{ $record->created_at->format('M d, Y h:i A') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No recent records found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show medicine details when selected
        document.getElementById('medicine').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const infoBox = document.getElementById('medicineInfo');
            
            if (this.value) {
                document.getElementById('medicineCategory').textContent = selectedOption.dataset.category;
                document.getElementById('medicineStock').textContent = selectedOption.dataset.stock + ' units';
                document.getElementById('medicineExpiry').textContent = selectedOption.dataset.expiry;
                infoBox.classList.add('show');
                
                // Set max quantity to available stock
                document.getElementById('quantity').max = selectedOption.dataset.stock;
            } else {
                infoBox.classList.remove('show');
            }
        });

        // Validate quantity doesn't exceed stock
        document.getElementById('quantity').addEventListener('input', function() {
            const medicineSelect = document.getElementById('medicine');
            const selectedOption = medicineSelect.options[medicineSelect.selectedIndex];
            
            if (selectedOption && selectedOption.value) {
                const maxStock = parseInt(selectedOption.dataset.stock);
                if (parseInt(this.value) > maxStock) {
                    this.value = maxStock;
                    alert('Quantity cannot exceed available stock (' + maxStock + ' units)');
                }
            }
        });
    </script>
</body>
</html>