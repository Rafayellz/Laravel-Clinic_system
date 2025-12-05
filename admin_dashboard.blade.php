<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Admin Dashboard</title>
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
        
        .stat-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
        
        .appointment-status {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .status-item {
            text-align: center;
            flex: 1;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 8px;
        }
        
        .status-item:hover {
            background-color: #f8f9fa;
        }
        
        .status-count {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .status-label {
            font-size: 14px;
            color: #6c757d;
        }
        
        .quick-actions .btn {
            margin: 5px;
            padding: 10px 15px;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-approved {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .badge-cancelled {
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

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 20px;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .refresh-btn {
            cursor: pointer;
            transition: transform 0.3s;
        }

        .refresh-btn:hover {
            transform: rotate(180deg);
        }

        .notification-badge {
            position: relative;
        }

        .notification-badge .badge {
            position: absolute;
            top: -8px;
            right: -8px;
        }

        .animate-count {
            animation: countUp 0.5s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            <a class="nav-link active" href="{{ route('admin_dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('admin_manage_appointments') }}">
                <i class="bi bi-calendar-check"></i>
                <span>Manage Appointments</span>
            </a> 
            <a class="nav-link" href="{{ route('admin_manage_users') }}">
                <i class="bi bi-people"></i>
                <span>Manage Users</span>
            </a>
            <a class="nav-link" href="{{ route('admin_reports') }}">
                <i class="bi bi-bar-chart"></i> 
                <span>Reports</span>
            </a>
            <a class="nav-link" href="{{ route('admin_medicine_inventory') }}">
                <i class="bi bi-capsule"></i>
                <span>Medicine Inventory</span>
            </a>
            <a class="nav-link" href="{{ route('admin_announcement') }}">
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

    <!-- Main Content - Vue.js App -->
    <div class="main-content" id="dashboardApp">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Doctor Dashboard</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3 notification-badge" style="position: relative; cursor: pointer;" @click="showNotifications">
                        <i class="bi bi-bell text-muted fs-5"></i>
                        <span v-if="pendingCount > 0" class="badge bg-danger rounded-pill" style="font-size: 0.65rem;">
                            {{ pendingCount }}
                        </span>
                    </div>
                    <div class="me-3 refresh-btn" @click="refreshData" title="Refresh Data">
                        <i class="bi bi-arrow-clockwise text-muted fs-5" :class="{ 'spinning': isRefreshing }"></i>
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

        <!-- Welcome Card -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <div class="welcome-text">
                    <h3>Welcome back, Doctor!</h3>
                    <p class="mb-0">Here's what's happening with your clinic today. Last updated: {{ lastUpdated }}</p>
                </div>
                <div class="welcome-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading dashboard data...</p>
        </div>

        <!-- Dashboard Content -->
        <div v-if="!loading">
            <!-- Appointment Stats -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--primary-green);">
                                <i class="bi bi-calendar-day"></i>
                            </div>
                            <div class="stat-value animate-count">
                                {{ stats.todayAppointments }}<span class="text-muted" style="font-size: 18px;">/{{ stats.maxAppointments }}</span>
                            </div>
                            <div class="stat-label">Total Appointments Today</div>
                            <div class="progress mt-2" style="height: 6px; width: 100%;">
                                <div class="progress-bar bg-success" role="progressbar" :style="{ width: appointmentPercentage + '%' }"></div>
                            </div>
                            <small class="text-muted mt-1">{{ remainingSlots }} slots remaining</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Appointment Status</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-secondary" :class="{ active: timeFilter === 'today' }" @click="timeFilter = 'today'; filterAppointments()">Today</button>
                                    <button type="button" class="btn btn-outline-secondary" :class="{ active: timeFilter === 'week' }" @click="timeFilter = 'week'; filterAppointments()">This Week</button>
                                    <button type="button" class="btn btn-outline-secondary" :class="{ active: timeFilter === 'month' }" @click="timeFilter = 'month'; filterAppointments()">This Month</button>
                                </div>
                            </div>
                            <div class="appointment-status">
                                <div class="status-item" @click="filterByStatus('pending')">
                                    <div class="status-count text-warning animate-count">{{ stats.pending }}</div>
                                    <div class="status-label">Pending</div>
                                </div>
                                <div class="status-item" @click="filterByStatus('approved')">
                                    <div class="status-count text-success animate-count">{{ stats.approved }}</div>
                                    <div class="status-label">Approved</div>
                                </div>
                                <div class="status-item" @click="filterByStatus('cancelled')">
                                    <div class="status-count text-danger animate-count">{{ stats.cancelled }}</div>
                                    <div class="status-label">Cancelled</div>
                                </div>
                                <div class="status-item" @click="filterByStatus('completed')">
                                    <div class="status-count text-info animate-count">{{ stats.completed }}</div>
                                    <div class="status-label">Completed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Appointments Chart -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Weekly Appointments Overview</h5>
                    <div class="chart-container">
                        <canvas ref="appointmentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Quick Actions</h5>
                    <div class="quick-actions d-flex flex-wrap">
                        <a href="{{ route('admin_announcement') }}" class="btn btn btn-outline-success">
                            <i class="bi bi-megaphone me-2"></i>Add Announcement
                        </a>
                        <a href="{{ route('admin_add_medicine') }}" class="btn btn-outline-success">
                            <i class="bi bi-capsule me-2"></i>Add Medicine
                        </a>
                        <a href="{{ route('admin_manage_appointments') }}" class="btn btn-outline-success">
                            <i class="bi bi-calendar-check me-2"></i>Manage Appointments
                        </a>
                        <a href="{{ route('admin_reports') }}" class="btn btn-outline-success">
                            <i class="bi bi-bar-chart me-2"></i>Generate Report
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Appointments -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                Recent Appointments
                                <a href="{{ route('admin_manage_appointments') }}" class="btn btn-sm btn-outline-success">View All</a>
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Date & Time</th>
                                            <th>Service</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="appointment in recentAppointments" :key="appointment.id">
                                            <td>{{ appointment.patient }}</td>
                                            <td>{{ appointment.datetime }}</td>
                                            <td>{{ appointment.service }}</td>
                                            <td>
                                                <span :class="['badge', 'badge-' + appointment.status]">
                                                    {{ capitalizeStatus(appointment.status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr v-if="recentAppointments.length === 0">
                                            <td colspan="4" class="text-center text-muted">No recent appointments</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- System Status -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">System Status</h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Appointments Today</span>
                                    <span>{{ stats.todayAppointments }}/{{ stats.maxAppointments }}</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" :style="{ width: appointmentPercentage + '%' }"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Medicine Stock</span>
                                    <span>{{ medicineStock }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" :class="medicineStockClass" role="progressbar" :style="{ width: medicineStock + '%' }"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>System Uptime</span>
                                    <span>{{ systemUptime }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-info" role="progressbar" :style="{ width: systemUptime + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Announcements -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                Recent Announcements
                                <a href="{{ route('admin_announcement') }}" class="btn btn-sm btn-outline-success">View All</a>
                            </h5>
                            <div class="list-group list-group-flush">
                                <div v-for="announcement in announcements" :key="announcement.id" class="list-group-item list-group-item-action" style="cursor: pointer;">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ announcement.title }}</h6>
                                        <small>{{ announcement.date }}</small>
                                    </div>
                                    <p class="mb-1">{{ announcement.content }}</p>
                                </div>
                                <div v-if="announcements.length === 0" class="list-group-item text-center text-muted">
                                    No recent announcements
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"></script>
    
    <!-- Vue.js 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Replace these with data from Laravel controller
                    stats: {
                        todayAppointments: 0,
                        maxAppointments: 50,
                        pending: 0,
                        approved: 0,
                        cancelled: 0,
                        completed: 0
                    },
                    recentAppointments: [],
                    announcements: [],
                    weeklyData: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        data: [0, 0, 0, 0, 0, 0, 0]
                    },
                    medicineStock: 65,
                    systemUptime: 99.8,
                    loading: false,
                    isRefreshing: false,
                    timeFilter: 'today',
                    lastUpdated: '',
                    chart: null
                }
            },
            computed: {
                appointmentPercentage() {
                    return Math.round((this.stats.todayAppointments / this.stats.maxAppointments) * 100);
                },
                remainingSlots() {
                    return this.stats.maxAppointments - this.stats.todayAppointments;
                },
                pendingCount() {
                    return this.stats.pending;
                },
                medicineStockClass() {
                    if (this.medicineStock < 30) return 'bg-danger';
                    if (this.medicineStock < 60) return 'bg-warning';
                    return 'bg-success';
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize data from Laravel
                this.initializeFromBackend();
                this.updateLastUpdated();
                this.initChart();
            },
            methods: {
                // BACKEND CONNECTION: Initialize dashboard data from Laravel controller
                initializeFromBackend() {
                    // Replace with actual backend data:
                    // this.stats = @json($dashboardStats);
                    // this.recentAppointments = @json($recentAppointments);
                    // this.announcements = @json($announcements);
                    // this.weeklyData = @json($weeklyData);
                    
                    // Sample data for demonstration
                    this.stats = {
                        todayAppointments: 24,
                        maxAppointments: 50,
                        pending: 8,
                        approved: 14,
                        cancelled: 2,
                        completed: 5
                    };
                    
                    this.recentAppointments = [
                        { id: 1, patient: 'John Smith', datetime: 'Today, 10:30 AM', service: 'Medical Checkup', status: 'approved' },
                        { id: 2, patient: 'Maria Garcia', datetime: 'Today, 11:15 AM', service: 'Dental Consultation', status: 'pending' },
                        { id: 3, patient: 'Robert Johnson', datetime: 'Today, 2:00 PM', service: 'Vaccination', status: 'approved' },
                        { id: 4, patient: 'Sarah Williams', datetime: 'Today, 3:30 PM', service: 'Eye Checkup', status: 'cancelled' },
                        { id: 5, patient: 'Michael Brown', datetime: 'Tomorrow, 9:00 AM', service: 'Medical Checkup', status: 'pending' }
                    ];
                    
                    this.announcements = [
                        { id: 1, title: 'Flu Vaccination Campaign', content: 'Annual flu vaccination is now available for all students and staff.', date: '2 days ago' },
                        { id: 2, title: 'Clinic Hours Update', content: 'The clinic will close early on Friday for staff training.', date: '5 days ago' }
                    ];
                    
                    this.weeklyData = {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        data: [12, 19, 15, 22, 18, 8, 5]
                    };
                },

                // BACKEND CONNECTION: Fetch fresh data from server
                async refreshData() {
                    this.isRefreshing = true;
                    
                    try {
                        // Example API call to refresh data:
                        // const response = await fetch('/api/admin/dashboard-stats');
                        // const data = await response.json();
                        // this.stats = data.stats;
                        // this.recentAppointments = data.recentAppointments;
                        
                        // Simulate API call
                        await new Promise(resolve => setTimeout(resolve, 1000));
                        
                        this.updateLastUpdated();
                        this.updateChart();
                    } catch (error) {
                        console.error('Error refreshing data:', error);
                    } finally {
                        this.isRefreshing = false;
                    }
                },

                initChart() {
                    const ctx = this.$refs.appointmentChart;
                    if (!ctx) return;

                    this.chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: this.weeklyData.labels,
                            datasets: [{
                                label: 'Appointments',
                                data: this.weeklyData.data,
                                backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                borderWidth: 2,
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    callbacks: {
                                        label: function(context) {
                                            return 'Appointments: ' + context.parsed.y;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 5
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                },

                updateChart() {
                    if (this.chart) {
                        this.chart.data.datasets[0].data = this.weeklyData.data;
                        this.chart.update();
                    }
                },

                filterByStatus(status) {
                    // Navigate to appointments page with filter
                    window.location.href = `{{ route('admin_manage_appointments') }}?status=${status}`;
                },

                filterAppointments() {
                    // BACKEND CONNECTION: Filter appointments by time range
                    // You can make an API call here to fetch filtered data
                    console.log('Filtering by:', this.timeFilter);
                },

                showNotifications() {
                    // Show notifications or navigate to appointments
                    if (this.pendingCount > 0) {
                        this.filterByStatus('pending');
                    }
                },

                updateLastUpdated() {
                    const now = new Date();
                    this.lastUpdated = now.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit'
                    });
                },

                capitalizeStatus(status) {
                    return status.charAt(0).toUpperCase() + status.slice(1);
                }
            }
        }).mount('#dashboardApp');
    </script>

</body>
</html>