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
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-rescheduled {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 0.85rem;
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
        .sortable-header {
            cursor: pointer;
            user-select: none;
            position: relative;
        }
        .sortable-header:hover {
            background-color: #e9ecef;
        }
        .sortable-header i {
            font-size: 0.7rem;
            margin-left: 5px;
            opacity: 0.5;
        }
        .sortable-header.active i {
            opacity: 1;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
            .table {
                font-size: 0.9rem;
            }
            .action-buttons {
                flex-direction: column;
            }
            .action-buttons .btn {
                width: 100%;
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
                        <div class="col-md-3">
                            <label class="form-label"><i class="fas fa-filter me-2"></i>Filter by Status</label>
                            <select v-model="filterStatus" class="form-select" @change="filterAppointments">
                                <option value="all">All Appointments</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="rescheduled">Rescheduled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="fas fa-search me-2"></i>Search</label>
                            <input 
                                v-model="searchQuery" 
                                type="text" 
                                class="form-control" 
                                placeholder="Search doctor, service..."
                                @input="filterAppointments">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="fas fa-calendar me-2"></i>Filter by Date</label>
                            <select v-model="dateFilter" class="form-select" @change="filterAppointments">
                                <option value="all">All Dates</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="past">Past</option>
                                <option value="today">Today</option>
                                <option value="this-week">This Week</option>
                                <option value="this-month">This Month</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button @click="resetFilters" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-redo me-2"></i>Reset Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- View Toggle & Counter -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="text-muted">Showing <strong>{{ filteredAppointments.length }}</strong> of <strong>{{ appointments.length }}</strong> appointments</span>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="{{ route('myappointment') }}" class="btn btn-outline-success">
                            <i class="fas fa-th-large me-2"></i>Card View
                        </a>
                        <a href="{{ route('myappointmenttable') }}" class="btn btn-outline-success active">
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

                <!-- Appointments Table (Vue.js) -->
                <div v-if="!loading && filteredAppointments.length > 0" class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sortable-header" :class="{ active: sortBy === 'date' }" @click="sort('date')">
                                            Date
                                            <i :class="getSortIcon('date')"></i>
                                        </th>
                                        <th>Time</th>
                                        <th class="sortable-header" :class="{ active: sortBy === 'service' }" @click="sort('service')">
                                            Service Type
                                            <i :class="getSortIcon('service')"></i>
                                        </th>
                                        <th>Reason</th>
                                        <th class="sortable-header" :class="{ active: sortBy === 'doctor' }" @click="sort('doctor')">
                                            Doctor
                                            <i :class="getSortIcon('doctor')"></i>
                                        </th>
                                        <th class="sortable-header" :class="{ active: sortBy === 'status' }" @click="sort('status')">
                                            Status
                                            <i :class="getSortIcon('status')"></i>
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="booking in paginatedAppointments" :key="booking.id">
                                        <td><strong>{{ formatTableDate(booking.appointment_date) }}</strong></td>
                                        <td>{{ booking.formatted_time }}</td>
                                        <td>
                                            <i class="fas fa-stethoscope me-1 text-muted"></i>
                                            {{ booking.service_name }}
                                        </td>
                                        <td>
                                            <span :title="booking.reason">
                                                {{ truncateText(booking.reason, 30) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span v-if="booking.doctor">{{ booking.doctor }}</span>
                                            <span v-else class="badge bg-secondary">Any Available</span>
                                        </td>
                                        <td>
                                            <span :class="['status-badge', 'status-' + booking.status]">
                                                <i :class="getStatusIcon(booking.status)" class="me-1"></i>
                                                {{ getStatusText(booking.status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a v-if="booking.status === 'pending' || booking.status === 'rejected'" 
                                                   :href="getRescheduleUrl(booking.id)" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Modify Appointment">
                                                    <i class="fas fa-edit"></i> Modify
                                                </a>
                                                <a v-else-if="booking.status === 'approved' || booking.status === 'rescheduled'" 
                                                   :href="getRescheduleUrl(booking.id)" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Reschedule">
                                                    <i class="fas fa-sync"></i> Reschedule
                                                </a>
                                                <span v-else class="text-muted">--</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination (Vue.js) -->
                        <div v-if="totalPages > 1" class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ startIndex + 1 }} to {{ endIndex }} of {{ filteredAppointments.length }} entries
                            </div>
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li v-for="page in visiblePages" :key="page" class="page-item" :class="{ active: page === currentPage }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Status Legend -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <h6 class="mb-3"><strong><i class="fas fa-info-circle me-2"></i>Status Guide:</strong></h6>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <span class="status-badge status-pending">Pending</span> 
                                    <small class="text-muted">Waiting for admin approval</small>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="status-badge status-approved">Approved</span> 
                                    <small class="text-muted">Appointment confirmed</small>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="status-badge status-rejected">Rejected</span> 
                                    <small class="text-muted">Appointment declined</small>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="status-badge status-rescheduled">Rescheduled</span> 
                                    <small class="text-muted">New date/time set</small>
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
                    appointments: [],
                    filteredAppointments: [],
                    filterStatus: 'all',
                    searchQuery: '',
                    dateFilter: 'all',
                    sortBy: 'date',
                    sortOrder: 'desc',
                    loading: false,
                    currentPage: 1,
                    itemsPerPage: 10
                }
            },
            computed: {
                totalPages() {
                    return Math.ceil(this.filteredAppointments.length / this.itemsPerPage);
                },
                startIndex() {
                    return (this.currentPage - 1) * this.itemsPerPage;
                },
                endIndex() {
                    const end = this.startIndex + this.itemsPerPage;
                    return end > this.filteredAppointments.length ? this.filteredAppointments.length : end;
                },
                paginatedAppointments() {
                    return this.filteredAppointments.slice(this.startIndex, this.endIndex);
                },
                visiblePages() {
                    const pages = [];
                    const maxVisible = 5;
                    let start = Math.max(1, this.currentPage - Math.floor(maxVisible / 2));
                    let end = Math.min(this.totalPages, start + maxVisible - 1);
                    
                    if (end - start + 1 < maxVisible) {
                        start = Math.max(1, end - maxVisible + 1);
                    }
                    
                    for (let i = start; i <= end; i++) {
                        pages.push(i);
                    }
                    return pages;
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize appointments from Laravel
                // this.appointments = @json($UserBooking);
                this.initializeFromBackend();
                this.filterAppointments();
            },
            methods: {
                // BACKEND CONNECTION: This method should get data from Laravel
                initializeFromBackend() {
                    // Replace this with actual backend data
                    // this.appointments = @json($UserBooking);
                    
                    // For now, keeping it empty
                    this.filteredAppointments = this.appointments;
                },

                filterAppointments() {
                    let filtered = [...this.appointments];

                    // Filter by status
                    if (this.filterStatus !== 'all') {
                        filtered = filtered.filter(app => app.status === this.filterStatus);
                    }

                    // Filter by date range
                    if (this.dateFilter !== 'all') {
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        
                        filtered = filtered.filter(app => {
                            const appDate = new Date(app.appointment_date);
                            appDate.setHours(0, 0, 0, 0);
                            
                            switch(this.dateFilter) {
                                case 'upcoming':
                                    return appDate >= today;
                                case 'past':
                                    return appDate < today;
                                case 'today':
                                    return appDate.getTime() === today.getTime();
                                case 'this-week':
                                    const weekFromNow = new Date(today);
                                    weekFromNow.setDate(today.getDate() + 7);
                                    return appDate >= today && appDate <= weekFromNow;
                                case 'this-month':
                                    return appDate.getMonth() === today.getMonth() && 
                                           appDate.getFullYear() === today.getFullYear();
                                default:
                                    return true;
                            }
                        });
                    }

                    // Search filter
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(app => 
                            (app.doctor && app.doctor.toLowerCase().includes(query)) ||
                            (app.service_name && app.service_name.toLowerCase().includes(query)) ||
                            (app.reason && app.reason.toLowerCase().includes(query))
                        );
                    }

                    this.filteredAppointments = filtered;
                    this.sortAppointments();
                    this.currentPage = 1; // Reset to first page when filtering
                },

                sort(column) {
                    if (this.sortBy === column) {
                        // Toggle sort order if same column
                        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        // New column, default to descending
                        this.sortBy = column;
                        this.sortOrder = 'desc';
                    }
                    this.sortAppointments();
                },

                sortAppointments() {
                    this.filteredAppointments.sort((a, b) => {
                        let compareA, compareB;
                        
                        switch(this.sortBy) {
                            case 'date':
                                compareA = new Date(a.appointment_date);
                                compareB = new Date(b.appointment_date);
                                break;
                            case 'service':
                                compareA = a.service_name.toLowerCase();
                                compareB = b.service_name.toLowerCase();
                                break;
                            case 'doctor':
                                compareA = (a.doctor || 'zzz').toLowerCase();
                                compareB = (b.doctor || 'zzz').toLowerCase();
                                break;
                            case 'status':
                                compareA = a.status.toLowerCase();
                                compareB = b.status.toLowerCase();
                                break;
                            default:
                                return 0;
                        }
                        
                        if (compareA < compareB) {
                            return this.sortOrder === 'asc' ? -1 : 1;
                        }
                        if (compareA > compareB) {
                            return this.sortOrder === 'asc' ? 1 : -1;
                        }
                        return 0;
                    });
                },

                getSortIcon(column) {
                    if (this.sortBy !== column) {
                        return 'fas fa-sort';
                    }
                    return this.sortOrder === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                },

                resetFilters() {
                    this.filterStatus = 'all';
                    this.searchQuery = '';
                    this.dateFilter = 'all';
                    this.sortBy = 'date';
                    this.sortOrder = 'desc';
                    this.currentPage = 1;
                    this.filterAppointments();
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                formatTableDate(dateString) {
                    const date = new Date(dateString);
                    const options = { month: 'short', day: 'numeric', year: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                },

                truncateText(text, length) {
                    if (!text) return '';
                    return text.length > length ? text.substring(0, length) + '...' : text;
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
                    return `/bookings/${bookingId}/reschedule`;
                }
            }
        }).mount('#appointmentsApp');
    </script>

</body>
</html>