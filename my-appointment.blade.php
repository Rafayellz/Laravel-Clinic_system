<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - My Appointments</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        }  
        .card-header {  
            background-color: white;  
            border-bottom: 1px solid #eee;  
            font-weight: 600;  
        }  
        .btn-primary-custom {  
            background-color: var(--primary-green);  
            border-color: var(--primary-green);  
            color: white;  
            padding: 12px 24px;  
            font-weight: 600;  
        }
        .btn-primary-custom:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        .appointment-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .badge-approved {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-rescheduled {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .appointment-card {
            transition: transform 0.2s;
        }
        .appointment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,.15);
        }
        .medicine-box {
            background-color: var(--light-green);
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        .medicine-item {
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .medicine-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .medicine-name {
            font-weight: 600;
            color: var(--dark-green);
        }
        .medicine-dosage {
            color: #666;
            font-size: 0.9rem;
        }
        .medicine-instructions {
            font-style: italic;
            color: #555;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 3rem;
            color: var(--primary-green);
            margin-bottom: 20px;
        }
        .filter-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .loading-spinner {
            text-align: center;
            padding: 40px;
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
            <a class="navbar-brand" href="{{ route('dashboard') }}">
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
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background:none; border:none; cursor:pointer;">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
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
                            <a class="nav-link" href="{{ route('bookappointment') }}">
                                <i class="fas fa-calendar-plus"></i> Book Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('myappointment') }}">
                                <i class="fas fa-calendar-check"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('diagnosis') }}">
                                <i class="fas fa-file-medical"></i> Diagnosis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link" style="border:none; background:none; width:100%; text-align:left;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content - Vue.js App -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4" id="appointmentsApp">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">My Appointments</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('bookappointment') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-calendar-plus me-2"></i>Book New Appointment
                        </a>
                    </div>
                </div>

                <!-- Success Message -->
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Filter Section (Vue.js) -->
                <div class="filter-section">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-filter me-2"></i>Filter by Status</label>
                            <select v-model="filterStatus" class="form-select" @change="filterAppointments">
                                <option value="all">All Appointments</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="rescheduled">Rescheduled</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-search me-2"></i>Search Doctor</label>
                            <input 
                                v-model="searchQuery" 
                                type="text" 
                                class="form-control" 
                                placeholder="Search by doctor name..."
                                @input="filterAppointments">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-sort me-2"></i>Sort by Date</label>
                            <select v-model="sortOrder" class="form-select" @change="sortAppointments">
                                <option value="desc">Newest First</option>
                                <option value="asc">Oldest First</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- View Toggle -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="text-muted">Showing {{ filteredAppointments.length }} of {{ appointments.length }} appointments</span>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="{{ route('myappointment') }}" class="btn btn-outline-success active">
                            <i class="fas fa-th-large me-2"></i>Card View
                        </a>
                        <a href="{{ route('myappointmenttable') }}" class="btn btn-outline-success">
                            <i class="fas fa-list me-2"></i>Table View
                        </a>
                    </div>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="loading-spinner">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Loading appointments...</p>
                </div>

                <!-- Empty State -->
                <div v-if="!loading && filteredAppointments.length === 0" class="card">
                    <div class="card-body empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h5 class="mt-3" v-if="appointments.length === 0">No Appointments Yet</h5>
                        <h5 class="mt-3" v-else>No Appointments Found</h5>
                        <p class="text-muted" v-if="appointments.length === 0">You haven't booked any appointments. Click the button below to schedule one.</p>
                        <p class="text-muted" v-else>Try adjusting your filters to see more results.</p>
                        <a href="{{ route('bookappointment') }}" class="btn btn-primary-custom mt-3" v-if="appointments.length === 0">
                            <i class="fas fa-calendar-plus me-2"></i>Book Your First Appointment
                        </a>
                        <button @click="resetFilters" class="btn btn-outline-secondary mt-3" v-else>
                            <i class="fas fa-redo me-2"></i>Reset Filters
                        </button>
                    </div>
                </div>

                <!-- Appointments Cards (Vue.js) -->
                <div v-if="!loading && filteredAppointments.length > 0" class="row">
                    <div v-for="booking in filteredAppointments" :key="booking.id" class="col-md-6 col-lg-4 mb-4">
                        <div class="card appointment-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title">
                                        <span v-if="booking.doctor">{{ booking.doctor }}</span>
                                        <span v-else class="text-muted">Any Doctor</span>
                                    </h5>
                                    <span :class="['appointment-badge', 'badge-' + booking.status]">
                                        <i :class="getStatusIcon(booking.status)" class="me-1"></i>
                                        {{ getStatusText(booking.status) }}
                                    </span>
                                </div>

                                <p class="card-text">
                                    <i class="fas fa-calendar-day me-2 text-muted"></i>{{ formatDate(booking.appointment_date) }}
                                </p>
                                <p class="card-text">
                                    <i class="far fa-clock me-2 text-muted"></i>{{ booking.formatted_time }}
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-stethoscope me-2 text-muted"></i>{{ booking.service_name }}
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-file-alt me-2 text-muted"></i><strong>Reason:</strong> {{ booking.reason }}
                                </p>

                                <div class="d-grid gap-2 mt-4">
                                    <a v-if="booking.status === 'pending' || booking.status === 'rejected'" 
                                       :href="getRescheduleUrl(booking.id)" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-2"></i> View Appointment
                                    </a>
                                    <template v-if="booking.status === 'approved' || booking.status === 'rescheduled'">
                                        <button class="btn btn-outline-success" disabled>
                                            <i class="fas fa-check-circle me-2"></i>Appointment Confirmed
                                        </button>
                                        <a :href="getRescheduleUrl(booking.id)" class="btn btn-outline-warning">
                                            <i class="fas fa-sync me-2"></i>Reschedule
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vue.js 3 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
    <!-- Vue.js App -->
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Replace this with actual data from Laravel
                    // Example: appointments: @json($UserBooking),
                    appointments: [
                        // This will be populated from Laravel backend
                        // Format should match your Laravel $UserBooking structure
                    ],
                    filteredAppointments: [],
                    filterStatus: 'all',
                    searchQuery: '',
                    sortOrder: 'desc',
                    loading: false
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize appointments from Laravel
                // Option 1: If you want to keep blade rendering, do this:
                // this.appointments = @json($UserBooking);
                
                // Option 2: Or fetch via AJAX/API:
                // this.fetchAppointments();
                
                // For demo purposes, using the blade data:
                this.initializeFromBackend();
                this.filterAppointments();
            },
            methods: {
                // BACKEND CONNECTION: This method should get data from Laravel
                initializeFromBackend() {
                    // Replace this with actual backend data
                    // this.appointments = @json($UserBooking);
                    
                    // For now, keeping it empty so it shows empty state
                    // You can uncomment the line above when integrating with Laravel
                    this.filteredAppointments = this.appointments;
                },

                // BACKEND CONNECTION: Fetch appointments via API (optional approach)
                async fetchAppointments() {
                    this.loading = true;
                    try {
                        // Example API call to your Laravel backend
                        // const response = await fetch('/api/my-appointments');
                        // const data = await response.json();
                        // this.appointments = data.appointments;
                        
                        // For now, simulating loading
                        setTimeout(() => {
                            this.loading = false;
                        }, 500);
                    } catch (error) {
                        console.error('Error fetching appointments:', error);
                        this.loading = false;
                    }
                },

                filterAppointments() {
                    let filtered = [...this.appointments];

                    // Filter by status
                    if (this.filterStatus !== 'all') {
                        filtered = filtered.filter(app => app.status === this.filterStatus);
                    }

                    // Search by doctor name
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(app => 
                            (app.doctor && app.doctor.toLowerCase().includes(query))
                        );
                    }

                    this.filteredAppointments = filtered;
                    this.sortAppointments();
                },

                sortAppointments() {
                    this.filteredAppointments.sort((a, b) => {
                        const dateA = new Date(a.appointment_date);
                        const dateB = new Date(b.appointment_date);
                        
                        if (this.sortOrder === 'asc') {
                            return dateA - dateB;
                        } else {
                            return dateB - dateA;
                        }
                    });
                },

                resetFilters() {
                    this.filterStatus = 'all';
                    this.searchQuery = '';
                    this.sortOrder = 'desc';
                    this.filterAppointments();
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                },

                getStatusText(status) {
                    const statusMap = {
                        'pending': 'Pending',
                        'approved': 'Approved',
                        'rejected': 'Rejected',
                        'rescheduled': 'Rescheduled'
                    };
                    return statusMap[status] || status;
                },

                getStatusIcon(status) {
                    const iconMap = {
                        'pending': 'fas fa-clock',
                        'approved': 'fas fa-check-circle',
                        'rejected': 'fas fa-times-circle',
                        'rescheduled': 'fas fa-sync'
                    };
                    return iconMap[status] || 'fas fa-circle';
                },

                // BACKEND CONNECTION: These URLs should use your Laravel routes
                getRescheduleUrl(bookingId) {
                    // This will use your existing Laravel route
                    return `/bookings/${bookingId}/reschedule`;
                    // Or with route helper: return `{{ route('bookings.reschedule-form', '') }}/${bookingId}`;
                }
            }
        }).mount('#appointmentsApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    To connect this Vue.js app with your Laravel backend, add this inside the <script> section:
    
    1. Initialize appointments data from Laravel (in the mounted() method):
       this.appointments = @json($UserBooking);
    
    2. Make sure your Laravel controller passes the data in the correct format:
       public function myappointment() {
           $UserBooking = Booking::where('user_id', auth()->id())
               ->with('doctor')
               ->orderBy('appointment_date', 'desc')
               ->get();
           
           return view('patient.myappointment', compact('UserBooking'));
       }
    
    3. The Vue app will automatically handle filtering, searching, and sorting
       while preserving all your existing Laravel routes and functionality.
    
    4. All existing blade routes ({{ route('...') }}) remain unchanged.
    
    ==========================================
    -->
</body>
</html>