<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Staff Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        .badge-completed {
            background-color: #d1ecf1;
            color: #0c5460;
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
        
        .notes-section textarea {
            resize: none;
            min-height: 120px;
        }

        .chart-container {
            position: relative;
            height: 250px;
            margin-top: 15px;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
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

        .refresh-btn {
            cursor: pointer;
            transition: transform 0.3s;
        }

        .refresh-btn:hover {
            transform: rotate(180deg);
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
            <a class="nav-link active" href="{{ route('staff_dashboard') }}">
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

    <!-- Main Content - Vue.js App -->
    <div class="main-content" id="staffDashboardApp">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Staff Dashboard</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3 refresh-btn" @click="refreshData" title="Refresh Data">
                        <i class="bi bi-arrow-clockwise text-muted fs-5" :class="{ 'spinning': isRefreshing }"></i>
                    </div>
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
                    <h3>Welcome back, Staff!</h3>
                    <p class="mb-0">Here's today's schedule and tasks. Last updated: {{ lastUpdated }}</p>
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
            <p class="mt-3 text-muted">Loading dashboard...</p>
        </div>

        <!-- Dashboard Stats -->
        <div v-if="!loading" class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--primary-green);">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-value animate-count">{{ stats.patientsToday }}</div>
                        <div class="stat-label">Patients Today</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: #ffc107;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-value animate-count">{{ stats.pendingTasks }}</div>
                        <div class="stat-label">Pending Tasks</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <div class="stat-value animate-count">{{ stats.medicinesGiven }}</div>
                        <div class="stat-label">Medicines Given</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.1); color: #6c757d;">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value animate-count">{{ stats.completedTasks }}</div>
                        <div class="stat-label">Completed Tasks</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Activity Chart -->
        <div v-if="!loading" class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Weekly Activity Overview</h5>
                <div class="chart-container">
                    <canvas ref="activityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div v-if="!loading" class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="quick-actions d-flex flex-wrap">
                    <a href="{{ route('staff_give_medicine') }}" class="btn btn-outline-success">
                        <i class="bi bi-capsule me-2"></i>Give Medicine
                    </a>
                    <a href="{{ route('staff_inventory_medicine') }}" class="btn btn-outline-success">
                        <i class="bi bi-capsule me-2"></i>Medicine Inventory
                    </a>
                    <a href="{{ route('staff_notifications') }}" class="btn btn-outline-success">
                        <i class="bi bi-bell me-2"></i>Notifications
                    </a>
                    <a href="{{ route('staff_reports') }}" class="btn btn-outline-success">
                        <i class="bi bi-bar-chart me-2"></i>Generate Report
                    </a>
                </div>
            </div>
        </div>

        <div v-if="!loading" class="row">
            <!-- Today's Appointments -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Today's Appointments <span class="badge bg-success">{{ appointments.length }}</span>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-secondary" :class="{ active: appointmentFilter === 'all' }" @click="appointmentFilter = 'all'">All</button>
                                <button type="button" class="btn btn-outline-secondary" :class="{ active: appointmentFilter === 'pending' }" @click="appointmentFilter = 'pending'">Pending</button>
                                <button type="button" class="btn btn-outline-secondary" :class="{ active: appointmentFilter === 'approved' }" @click="appointmentFilter = 'approved'">Approved</button>
                            </div>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Time</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="appointment in filteredAppointments" :key="appointment.id">
                                        <td><strong>{{ appointment.patient }}</strong></td>
                                        <td>{{ appointment.time }}</td>
                                        <td>{{ appointment.service }}</td>
                                        <td>
                                            <span :class="getStatusBadge(appointment.status)">
                                                {{ capitalizeStatus(appointment.status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" @click="viewAppointment(appointment.id)">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="filteredAppointments.length === 0">
                                        <td colspan="5" class="text-center text-muted">No appointments found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Notes & Tasks -->
            <div class="col-md-4">
                <!-- Daily Notes -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daily Notes</h5>
                        <div class="notes-section">
                            <textarea 
                                class="form-control" 
                                v-model="dailyNotes"
                                placeholder="Add your notes for today..."
                                maxlength="500"></textarea>
                            <small class="text-muted d-block mt-1">{{ dailyNotes.length }}/500 characters</small>
                            <div class="d-grid mt-2">
                                <button class="btn btn-success" @click="saveNotes" :disabled="savingNotes">
                                    <span v-if="!savingNotes">
                                        <i class="bi bi-save me-2"></i>Save Notes
                                    </span>
                                    <span v-else>
                                        <span class="spinner-border spinner-border-sm me-2"></span>Saving...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Tasks <span class="badge bg-warning text-dark">{{ tasks.length }}</span></h5>
                        <div class="list-group list-group-flush">
                            <div v-for="task in tasks" :key="task.id" class="list-group-item list-group-item-action" style="cursor: pointer;" @click="viewTask(task.id)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ task.title }}</h6>
                                    <small :class="getTaskUrgency(task.dueDate)">{{ task.dueDate }}</small>
                                </div>
                                <p class="mb-1">{{ task.description }}</p>
                            </div>
                            <div v-if="tasks.length === 0" class="list-group-item text-center text-muted">
                                No upcoming tasks
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    // BACKEND CONNECTION: Replace with Laravel data
                    // stats: @json($stats),
                    // appointments: @json($appointments),
                    // tasks: @json($tasks),
                    stats: {
                        patientsToday: 0,
                        pendingTasks: 0,
                        medicinesGiven: 0,
                        completedTasks: 0
                    },
                    appointments: [],
                    tasks: [],
                    weeklyData: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        patientsData: [0, 0, 0, 0, 0, 0, 0],
                        medicinesData: [0, 0, 0, 0, 0, 0, 0]
                    },
                    dailyNotes: '',
                    appointmentFilter: 'all',
                    loading: false,
                    isRefreshing: false,
                    savingNotes: false,
                    lastUpdated: '',
                    activityChart: null
                }
            },
            computed: {
                filteredAppointments() {
                    if (this.appointmentFilter === 'all') {
                        return this.appointments;
                    }
                    return this.appointments.filter(a => a.status === this.appointmentFilter);
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize from Laravel
                this.initializeFromBackend();
                this.updateLastUpdated();
                this.$nextTick(() => {
                    this.initChart();
                });
            },
            methods: {
                // BACKEND CONNECTION: Get data from Laravel
                initializeFromBackend() {
                    // Uncomment to use Laravel data:
                    // this.stats = @json($stats);
                    // this.appointments = @json($appointments);
                    // this.tasks = @json($tasks);
                    // this.weeklyData = @json($weeklyData);
                    // this.dailyNotes = @json($dailyNotes ?? '');
                    
                    // Sample data for demonstration
                    this.stats = {
                        patientsToday: 18,
                        pendingTasks: 5,
                        medicinesGiven: 12,
                        completedTasks: 32
                    };
                    
                    this.appointments = [
                        { id: 1, patient: 'John Smith', time: '10:30 AM', service: 'Medical Checkup', status: 'approved' },
                        { id: 2, patient: 'Maria Garcia', time: '11:15 AM', service: 'Dental Consultation', status: 'pending' },
                        { id: 3, patient: 'Robert Johnson', time: '2:00 PM', service: 'Vaccination', status: 'approved' },
                        { id: 4, patient: 'Sarah Williams', time: '3:30 PM', service: 'Eye Checkup', status: 'completed' },
                        { id: 5, patient: 'Michael Brown', time: '4:15 PM', service: 'Medical Checkup', status: 'pending' }
                    ];
                    
                    this.tasks = [
                        { id: 1, title: 'Stock Medicine Inventory', description: 'Check and restock common medicines.', dueDate: 'Today' },
                        { id: 2, title: 'Prepare Vaccination Supplies', description: 'For the scheduled vaccination appointments.', dueDate: 'Tomorrow' },
                        { id: 3, title: 'Monthly Equipment Check', description: 'Inspect and maintain medical equipment.', dueDate: '3 days' }
                    ];
                    
                    this.weeklyData = {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        patientsData: [15, 22, 18, 25, 20, 8, 5],
                        medicinesData: [8, 14, 11, 16, 12, 4, 2]
                    };
                },

                initChart() {
                    const ctx = this.$refs.activityChart;
                    if (!ctx) return;

                    this.activityChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: this.weeklyData.labels,
                            datasets: [
                                {
                                    label: 'Patients Served',
                                    data: this.weeklyData.patientsData,
                                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                    borderColor: 'rgba(40, 167, 69, 1)',
                                    borderWidth: 2,
                                    borderRadius: 5
                                },
                                {
                                    label: 'Medicines Given',
                                    data: this.weeklyData.medicinesData,
                                    backgroundColor: 'rgba(13, 110, 253, 0.6)',
                                    borderColor: 'rgba(13, 110, 253, 1)',
                                    borderWidth: 2,
                                    borderRadius: 5
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        padding: 15,
                                        font: { size: 12 }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
                                    callbacks: {
                                        label: function(context) {
                                            return context.dataset.label + ': ' + context.parsed.y;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 5 },
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                                },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                },

                // BACKEND CONNECTION: Refresh dashboard data
                async refreshData() {
                    this.isRefreshing = true;
                    try {
                        // Example API call:
                        // const response = await fetch('/api/staff/dashboard-refresh');
                        // const data = await response.json();
                        // this.stats = data.stats;
                        // this.appointments = data.appointments;
                        
                        await new Promise(resolve => setTimeout(resolve, 1000));
                        this.updateLastUpdated();
                        if (this.activityChart) {
                            this.activityChart.update();
                        }
                    } catch (error) {
                        console.error('Error refreshing data:', error);
                    } finally {
                        this.isRefreshing = false;
                    }
                },

                // BACKEND CONNECTION: Save daily notes
                async saveNotes() {
                    this.savingNotes = true;
                    try {
                        // Example API call:
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // formData.append('notes', this.dailyNotes);
                        // await fetch('/api/staff/save-notes', {
                        //     method: 'POST',
                        //     body: formData
                        // });
                        
                        await new Promise(resolve => setTimeout(resolve, 500));
                        alert('Notes saved successfully!');
                    } catch (error) {
                        console.error('Error saving notes:', error);
                        alert('Failed to save notes');
                    } finally {
                        this.savingNotes = false;
                    }
                },

                viewAppointment(id) {
                    window.location.href = `/staff/appointments/${id}`;
                },

                viewTask(id) {
                    console.log('Viewing task:', id);
                },

                updateLastUpdated() {
                    const now = new Date();
                    this.lastUpdated = now.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit'
                    });
                },

                getStatusBadge(status) {
                    const badges = {
                        'pending': 'badge badge-pending',
                        'approved': 'badge badge-approved',
                        'completed': 'badge badge-completed',
                        'cancelled': 'badge badge-cancelled'
                    };
                    return badges[status] || 'badge bg-secondary';
                },

                capitalizeStatus(status) {
                    return status.charAt(0).toUpperCase() + status.slice(1);
                },

                getTaskUrgency(dueDate) {
                    if (dueDate === 'Today') return 'text-danger';
                    if (dueDate === 'Tomorrow') return 'text-warning';
                    return 'text-muted';
                }
            }
        }).mount('#staffDashboardApp');
    </script>

    <style>
        .spinning {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    In Laravel Controller (StaffController.php):
    
    public function dashboard() {
        $stats = [
            'patientsToday' => Appointment::whereDate('appointment_date', today())->count(),
            'pendingTasks' => Task::where('status', 'pending')->count(),
            'medicinesGiven' => MedicineLog::whereDate('created_at', today())->count(),
            'completedTasks' => Task::where('status', 'completed')->count()
        ];
        