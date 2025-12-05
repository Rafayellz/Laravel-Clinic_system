<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic - Diagnosis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #28a745;
            --light-green: #d4edda;
            --dark-green: #1e7e34;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--dark-green);
        }
        
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 5px rgba(0,0,0,.1);
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            transition: transform 0.2s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 2px solid #eee;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
            padding: 10px 20px;
            font-weight: 600;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        
        .health-stat {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid var(--primary-green);
        }
        
        .health-stat-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .health-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-green);
        }
        
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 30px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: -30px;
            width: 2px;
            background-color: var(--light-green);
        }
        
        .timeline-item:last-child::before {
            display: none;
        }
        
        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: var(--primary-green);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary-green);
        }
        
        .record-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e0e0e0;
        }
        
        .prescription-badge {
            background-color: #e7f3ff;
            color: #0066cc;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
            margin: 5px 5px 5px 0;
        }
        
        .diagnosis-tag {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 0.85rem;
            display: inline-block;
        }
        
        .prescription-item {
            border-left: 3px solid var(--primary-green);
            padding: 12px 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        .search-box {
            position: relative;
            margin-bottom: 20px;
        }
        
        .search-box input {
            padding-left: 40px;
            border-radius: 25px;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC Logo" height="30" class="d-inline-block align-text-top me-2">
                DNSC Clinic Appointment System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ $patient->first_name }} {{ $patient->last_name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book_appointment') }}">
                                <i class="fas fa-calendar-plus"></i> Book Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my_appointment') }}">
                                <i class="fas fa-calendar-check"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('diagnosis') }}">
                                <i class="fas fa-file-medical"></i> Diagnosis
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link" style="border:none; background:none; width:100%; text-align:left; padding:var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x); cursor:pointer;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span> 
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Diagnosis</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-primary-custom">
                            <i class="fas fa-download me-2"></i>Download Records
                        </button>
                    </div>
                </div>

                <!-- Health Overview Cards -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="health-stat">
                            <div class="health-stat-label">
                                <i class="fas fa-birthday-cake me-1"></i> Age
                            </div>
                            <div class="health-stat-value">{{ $user->age ?? 'N/A' }}</div>
                            <small class="text-muted">
                                @if($user->date_of_birth)
                                    Born: {{ \Carbon\Carbon::parse($user->date_of_birth)->format('M d, Y') }}
                                @else
                                    Not set
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="health-stat" style="border-left-color: #007bff;">
                            <div class="health-stat-label">
                                <i class="fas fa-weight me-1"></i> Weight
                            </div>
                            <div class="health-stat-value" style="color: #007bff;">{{ $user->weight ?? 'N/A' }} kg</div>
                            <small class="text-muted">
                                @if($user->weight)
                                    Last updated: {{ $user->updated_at->format('M d, Y') }}
                                @else
                                    Not set
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="health-stat" style="border-left-color: #ffc107;">
                            <div class="health-stat-label">
                                <i class="fas fa-ruler-vertical me-1"></i> Height
                            </div>
                            <div class="health-stat-value" style="color: #ffc107;">{{ $user->height ?? 'N/A' }} cm</div>
                            <small class="text-muted">
                                @if($user->height)
                                    Last updated: {{ $user->updated_at->format('M d, Y') }}
                                @else
                                    Not set
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="health-stat" style="border-left-color: #17a2b8;">
                            <div class="health-stat-label">
                                <i class="fas fa-file-medical me-1"></i> Total Records
                            </div>
                            <div class="health-stat-value" style="color: #17a2b8;">{{ $bookings->count() }}</div>
                            <small class="text-muted">Since {{ $user->created_at->format('Y') }}</small>
                        </div>
                    </div>
                </div>
                
                <!-- Search and Filter -->
               <div class="row mb-4">
                <form method="GET" action="{{ route('diagnosis') }}" class="w-100">
                    <div class="col-md-8">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control" 
                                placeholder="Search by diagnosis, doctor, or date..."
                                value="{{ $search ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="filter" class="form-select" onchange="this.form.submit()">
                            <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All Records</option>
                            <option value="this_year" {{ $filter === 'this_year' ? 'selected' : '' }}>This Year</option>
                            <option value="last_6_months" {{ $filter === 'last_6_months' ? 'selected' : '' }}>Last 6 Months</option>
                            <option value="last_3_months" {{ $filter === 'last_3_months' ? 'selected' : '' }}>Last 3 Months</option>
                        </select>
                    </div>
                </form>
            </div>

                <!-- Current Prescriptions -->
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-prescription-bottle-alt text-success me-2"></i>
                            Active Prescriptions
                        </div>
                        <span class="badge bg-success">2 Active</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="prescription-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><i class="fas fa-pills me-2"></i>Amoxicillin 500mg</h6>
                                            <p class="mb-1"><strong>Dosage:</strong> 3 times daily after meals</p>
                                            <p class="mb-1"><strong>Duration:</strong> 7 days</p>
                                            <p class="mb-1"><strong>Quantity:</strong> 21 tablets</p>
                                            <small class="text-muted">Prescribed by Dr. Maria Santos on Oct 10, 2025</small>
                                        </div>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prescription-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><i class="fas fa-pills me-2"></i>Cetirizine 10mg</h6>
                                            <p class="mb-1"><strong>Dosage:</strong> Once daily before bedtime</p>
                                            <p class="mb-1"><strong>Duration:</strong> As needed</p>
                                            <p class="mb-1"><strong>Quantity:</strong> 30 tablets</p>
                                            <small class="text-muted">Prescribed by Dr. Anna Reyes on Oct 5, 2025</small>
                                        </div>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Records Timeline -->           
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-history text-primary me-2"></i>
                        Medical History Timeline
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @forelse($bookings as $booking)
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="record-card">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h5 class="mb-1">
                                                    {{ $booking->reason ?? 'Appointment' }}
                                                </h5>
                                                <small class="text-muted">
                                                    <i class="far fa-calendar me-1"></i>
                                                    {{  $booking->appointment_date->format('l, F j, Y')  }}
                                                </small>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#recordModal{{ $booking->id }}">
                                                <i class="fas fa-eye me-1"></i>View Details
                                            </button>
                                        </div>
                                        <p class="mb-2">
                                            <i class="fas fa-user-md me-2 text-success"></i>
                                            <strong>{{ $booking->doctor ?? 'N/A' }}</strong>
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-notes-medical me-2 text-info"></i>
                                            {{ $booking->service_name }}
                                        </p>
                                        <div class="mt-2">
                                            <span class="badge bg-info">{{ ucfirst($booking->status) }}</span>
                                            <small class="text-muted ms-2">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for each booking -->
                                <div class="modal fade" id="recordModal{{ $booking->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: var(--primary-green); color: white;">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-file-medical me-2"></i>Appointment Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Appointment ID:</strong> APP-{{ $booking->id }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->appointment_date)->format('F d, Y') }}
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Patient:</strong> {{ $user->first_name }} {{ $user->last_name }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Doctor:</strong><br>
                                                    <span class="text-success">
                                                        <i class="fas fa-user-md me-1"></i>
                                                        {{ $booking->doctor ?? 'N/A' }}
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Service Type:</strong><br>
                                                    <span class="diagnosis-tag">{{ $booking->service_type ?? 'N/A' }}</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Reason for Visit:</strong><br>
                                                    <p class="mt-1">{{ $booking->reason ?? 'No reason provided' }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Status:</strong><br>
                                                    @if ($booking->status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($booking->status === 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif ($booking->status === 'rescheduled')
                                                        <span class="badge bg-info">Rescheduled</span>
                                                    @elseif ($booking->status === 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @elseif ($booking->status === 'completed')
                                                        <span class="badge bg-primary">Completed</span>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Booked On:</strong><br>
                                                    <p class="mt-1">{{ $booking->created_at->format('F d, Y \a\t h:i A') }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    No appointment history yet. <a href="{{ route('book_appointment') }}">Book your first appointment</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal 1 -->
    <div class="modal fade" id="recordModal1" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--primary-green); color: white;">
                    <h5 class="modal-title"><i class="fas fa-file-medical me-2"></i>Medical Record Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Record ID:</strong> REC-012
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong> October 10, 2025
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Patient:</strong> John Doe
                        </div>
                        <div class="col-md-6">
                            <strong>Student ID:</strong> 2023-00123
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Doctor:</strong><br>
                        <span class="text-success"><i class="fas fa-user-md me-1"></i>Dr. Maria Santos</span>
                    </div>
                    <div class="mb-3">
                        <strong>Diagnosis:</strong><br>
                        <span class="diagnosis-tag">Upper Respiratory Tract Infection</span>
                    </div>
                    <div class="mb-3">
                        <strong>Symptoms:</strong><br>
                        <p class="mt-1">Cough, sore throat, mild fever</p>
                    </div>
                    <div class="mb-3">
                        <strong>Prescriptions:</strong><br>
                        <div class="prescription-item mt-2">
                            <h6 class="mb-1"><i class="fas fa-pills me-2"></i>Amoxicillin 500mg</h6>
                            <p class="mb-0"><strong>Dosage:</strong> 3x daily after meals</p>
                            <p class="mb-0"><strong>Quantity:</strong> 21 tablets</p>
                            <p class="mb-0"><strong>Duration:</strong> 7 days</p>
                        </div>
                        <div class="prescription-item">
                            <h6 class="mb-1"><i class="fas fa-pills me-2"></i>Paracetamol 500mg</h6>
                            <p class="mb-0"><strong>Dosage:</strong> As needed for fever</p>
                            <p class="mb-0"><strong>Quantity:</strong> 10 tablets</p>
                            <p class="mb-0"><strong>Duration:</strong> As needed</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Notes:</strong><br>
                        <p class="mt-1">Patient advised to rest and drink plenty of fluids. Follow-up if symptoms persist after 5 days.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary-custom">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="recordModal2" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--primary-green); color: white;">
                    <h5 class="modal-title"><i class="fas fa-file-medical me-2"></i>Medical Record Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Record ID:</strong> REC-011
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong> October 5, 2025
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Patient:</strong> John Doe
                        </div>
                        <div class="col-md-6">
                            <strong>Student ID:</strong> 2023-00123
                        </div>
                    </div>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>