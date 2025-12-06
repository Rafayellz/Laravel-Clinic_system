<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Reports</title>
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
            cursor: pointer;
            user-select: none;
        }

        .table th:hover {
            background-color: #f8f9fa;
        }

        .table th i {
            font-size: 0.7rem;
            margin-left: 5px;
            opacity: 0.5;
        }

        .table th.active i {
            opacity: 1;
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
        
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }
        
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .animate-number {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .trend-icon {
            font-size: 0.9rem;
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
            <a class="nav-link" href="{{ route('admin_dashboard') }}">
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
            <a class="nav-link active" href="{{ route('admin_reports') }}">
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
    <div class="main-content" id="reportsApp">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Reports & Analytics</h4>
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
                            <li><a class="dropdown-item" href="login.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Filter Section (Vue.js) -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="reportType" class="form-label">Report Type</label>
                    <select class="form-select" v-model="filters.reportType" @change="applyFilters">
                        <option value="appointments">Appointments Overview</option>
                        <option value="services">Service Utilization</option>
                        <option value="demographics">Patient Demographics</option>
                        <option value="revenue">Revenue Reports</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="timePeriod" class="form-label">Time Period</label>
                    <select class="form-select" v-model="filters.timePeriod" @change="applyFilters">
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 3 Months</option>
                        <option value="180">Last 6 Months</option>
                        <option value="365">Last Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" v-model="filters.startDate" @change="applyFilters">
                </div>
                <div class="col-md-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" v-model="filters.endDate" @change="applyFilters">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <button class="btn btn-success me-2" @click="applyFilters">
                        <i class="bi bi-filter me-2"></i>Apply Filters
                    </button>
                    <button class="btn btn-outline-success" @click="exportReport">
                        <i class="bi bi-download me-2"></i>Export Report
                    </button>
                    <button class="btn btn-outline-secondary" @click="resetFilters">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading reports data...</p>
        </div>

        <!-- Charts (Vue.js with Chart.js) -->
        <div v-if="!loading" class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointments Trend</h5>
                        <div class="chart-container">
                            <canvas ref="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Service Distribution</h5>
                        <div class="chart-container">
                            <canvas ref="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments per Week/Month Table (Vue.js) -->
        <div v-if="!loading" class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Appointments per Week/Month
                            <button class="btn btn-sm btn-outline-success" @click="exportTableData">
                                <i class="bi bi-download me-2"></i>Export Data
                            </button>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th @click="sortTable('period')" :class="{ active: sortBy === 'period' }">
                                            Period
                                            <i :class="getSortIcon('period')"></i>
                                        </th>
                                        <th @click="sortTable('total')" :class="{ active: sortBy === 'total' }">
                                            Total Appointments
                                            <i :class="getSortIcon('total')"></i>
                                        </th>
                                        <th @click="sortTable('approved')" :class="{ active: sortBy === 'approved' }">
                                            Approved
                                            <i :class="getSortIcon('approved')"></i>
                                        </th>
                                        <th @click="sortTable('pending')" :class="{ active: sortBy === 'pending' }">
                                            Pending
                                            <i :class="getSortIcon('pending')"></i>
                                        </th>
                                        <th @click="sortTable('cancelled')" :class="{ active: sortBy === 'cancelled' }">
                                            Cancelled
                                            <i :class="getSortIcon('cancelled')"></i>
                                        </th>
                                        <th @click="sortTable('rate')" :class="{ active: sortBy === 'rate' }">
                                            Completion Rate
                                            <i :class="getSortIcon('rate')"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in sortedPeriodData" :key="item.period">
                                        <td><strong>{{ item.period }}</strong></td>
                                        <td class="animate-number">{{ item.total }}</td>
                                        <td class="animate-number">{{ item.approved }}</td>
                                        <td class="animate-number">{{ item.pending }}</td>
                                        <td class="animate-number">{{ item.cancelled }}</td>
                                        <td class="animate-number">{{ item.rate }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Common Reasons Table (Vue.js) -->
        <div v-if="!loading" class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Most Common Consultation Reasons
                            <button class="btn btn-sm btn-outline-success" @click="viewServiceDetails">
                                <i class="bi bi-eye me-2"></i>View Details
                            </button>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th @click="sortServices('service')" :class="{ active: serviceSortBy === 'service' }">
                                            Service/Reason
                                            <i :class="getServiceSortIcon('service')"></i>
                                        </th>
                                        <th @click="sortServices('count')" :class="{ active: serviceSortBy === 'count' }">
                                            Count
                                            <i :class="getServiceSortIcon('count')"></i>
                                        </th>
                                        <th @click="sortServices('percentage')" :class="{ active: serviceSortBy === 'percentage' }">
                                            Percentage
                                            <i :class="getServiceSortIcon('percentage')"></i>
                                        </th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="service in sortedServiceData" :key="service.service">
                                        <td>{{ service.service }}</td>
                                        <td class="animate-number">{{ service.count }}</td>
                                        <td class="animate-number">{{ service.percentage }}%</td>
                                        <td>
                                            <span v-if="service.trend === 'up'" class="text-success trend-icon">
                                                <i class="bi bi-arrow-up"></i> Increased
                                            </span>
                                            <span v-else-if="service.trend === 'down'" class="text-warning trend-icon">
                                                <i class="bi bi-arrow-down"></i> Decreased
                                            </span>
                                            <span v-else class="text-muted trend-icon">
                                                <i class="bi bi-dash"></i> Stable
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Stats (Vue.js) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Report Summary</h5>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Total Appointments</span>
                                <span class="animate-number">{{ summary.total }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Approval Rate</span>
                                <span class="animate-number">{{ summary.approvalRate }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" role="progressbar" :style="{ width: summary.approvalRate + '%' }"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Cancellation Rate</span>
                                <span class="animate-number">{{ summary.cancellationRate }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" :style="{ width: summary.cancellationRate + '%' }"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Avg. Appointments/Day</span>
                                <span class="animate-number">{{ summary.avgPerDay }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" :style="{ width: (summary.avgPerDay / 50 * 100) + '%' }"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Report Actions</h5>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" @click="generateCustomReport">
                                <i class="bi bi-file-earmark-text me-2"></i>Generate Custom Report
                            </button>
                            <button class="btn btn-outline-success" @click="printReport">
                                <i class="bi bi-printer me-2"></i>Print Report
                            </button>
                            <button class="btn btn-outline-success" @click="emailReport">
                                <i class="bi bi-envelope me-2"></i>Email Report
                            </button>
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
                    // BACKEND CONNECTION: Replace with Laravel data
                    // Example: filters: @json($filters),
                    filters: {
                        reportType: 'appointments',
                        timePeriod: '30',
                        startDate: '',
                        endDate: ''
                    },
                    periodData: [],
                    serviceData: [],
                    summary: {
                        total: 0,
                        approvalRate: 0,
                        cancellationRate: 0,
                        avgPerDay: 0
                    },
                    trendChartData: {
                        labels: [],
                        data: []
                    },
                    pieChartData: {
                        labels: [],
                        data: []
                    },
                    loading: false,
                    sortBy: 'period',
                    sortOrder: 'desc',
                    serviceSortBy: 'count',
                    serviceSortOrder: 'desc',
                    trendChart: null,
                    pieChart: null
                }
            },
            computed: {
                sortedPeriodData() {
                    return [...this.periodData].sort((a, b) => {
                        let compareA, compareB;
                        
                        switch(this.sortBy) {
                            case 'period':
                                return this.sortOrder === 'asc' ? 1 : -1;
                            case 'total':
                            case 'approved':
                            case 'pending':
                            case 'cancelled':
                                compareA = a[this.sortBy];
                                compareB = b[this.sortBy];
                                break;
                            case 'rate':
                                compareA = parseFloat(a.rate);
                                compareB = parseFloat(b.rate);
                                break;
                            default:
                                return 0;
                        }
                        
                        if (compareA < compareB) return this.sortOrder === 'asc' ? -1 : 1;
                        if (compareA > compareB) return this.sortOrder === 'asc' ? 1 : -1;
                        return 0;
                    });
                },
                sortedServiceData() {
                    return [...this.serviceData].sort((a, b) => {
                        let compareA, compareB;
                        
                        switch(this.serviceSortBy) {
                            case 'service':
                                compareA = a.service.toLowerCase();
                                compareB = b.service.toLowerCase();
                                break;
                            case 'count':
                                compareA = a.count;
                                compareB = b.count;
                                break;
                            case 'percentage':
                                compareA = parseFloat(a.percentage);
                                compareB = parseFloat(b.percentage);
                                break;
                            default:
                                return 0;
                        }
                        
                        if (compareA < compareB) return this.serviceSortOrder === 'asc' ? -1 : 1;
                        if (compareA > compareB) return this.serviceSortOrder === 'asc' ? 1 : -1;
                        return 0;
                    });
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize data from Laravel
                this.initializeFromBackend();
                this.$nextTick(() => {
                    this.initCharts();
                });
            },
            methods: {
                // BACKEND CONNECTION: Get data from Laravel controller
                // In your Laravel Controller:
                // public function reports() {
                //     $periodData = [...]; // Your period statistics
                //     $serviceData = [...]; // Your service statistics
                //     $summary = [...]; // Summary data
                //     $trendChartData = [...]; // Chart data
                //     return view('admin.reports', compact('periodData', 'serviceData', 'summary', 'trendChartData'));
                // }
                initializeFromBackend() {
                    // BACKEND CONNECTION: Uncomment to use Laravel data
                    // this.periodData = @json($periodData);
                    // this.serviceData = @json($serviceData);
                    // this.summary = @json($summary);
                    // this.trendChartData = @json($trendChartData);
                    // this.pieChartData = @json($pieChartData);
                    
                    // Sample data for demonstration
                    this.periodData = [
                        { period: 'This Week', total: 142, approved: 118, pending: 18, cancelled: 6, rate: '83.1' },
                        { period: 'Last Week', total: 156, approved: 132, pending: 16, cancelled: 8, rate: '84.6' },
                        { period: 'This Month', total: 568, approved: 482, pending: 62, cancelled: 24, rate: '84.9' },
                        { period: 'Last Month', total: 612, approved: 524, pending: 68, cancelled: 20, rate: '85.6' },
                        { period: 'This Quarter', total: 1842, approved: 1584, pending: 198, cancelled: 60, rate: '86.0' }
                    ];
                    
                    this.serviceData = [
                        { service: 'Medical Checkup', count: 324, percentage: '28.5', trend: 'up' },
                        { service: 'Dental Consultation', count: 218, percentage: '19.2', trend: 'up' },
                        { service: 'Vaccination', count: 187, percentage: '16.5', trend: 'stable' },
                        { service: 'Eye Checkup', count: 156, percentage: '13.7', trend: 'down' },
                        { service: 'Flu/Cold Symptoms', count: 98, percentage: '8.6', trend: 'up' },
                        { service: 'Skin Conditions', count: 72, percentage: '6.3', trend: 'stable' },
                        { service: 'Other', count: 79, percentage: '7.0', trend: 'up' }
                    ];
                    
                    this.summary = {
                        total: 1134,
                        approvalRate: 85.2,
                        cancellationRate: 4.8,
                        avgPerDay: 37.8
                    };
                    
                    this.trendChartData = {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                        data: [142, 156, 168, 152, 148]
                    };
                    
                    this.pieChartData = {
                        labels: ['Medical Checkup', 'Dental', 'Vaccination', 'Eye Checkup', 'Other'],
                        data: [324, 218, 187, 156, 249]
                    };
                },

                initCharts() {
                    this.initTrendChart();
                    this.initPieChart();
                },

                initTrendChart() {
                    const ctx = this.$refs.trendChart;
                    if (!ctx) return;

                    this.trendChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: this.trendChartData.labels,
                            datasets: [{
                                label: 'Appointments',
                                data: this.trendChartData.data,
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
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
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
                                    ticks: { stepSize: 20 },
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                                },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                },

                initPieChart() {
                    const ctx = this.$refs.pieChart;
                    if (!ctx) return;

                    this.pieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: this.pieChartData.labels,
                            datasets: [{
                                data: this.pieChartData.data,
                                backgroundColor: [
                                    'rgba(40, 167, 69, 0.8)',
                                    'rgba(23, 162, 184, 0.8)',
                                    'rgba(255, 193, 7, 0.8)',
                                    'rgba(220, 53, 69, 0.8)',
                                    'rgba(108, 117, 125, 0.8)'
                                ],
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { padding: 15, font: { size: 12 } }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.parsed;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(1);
                                            return label + ': ' + value + ' (' + percentage + '%)';
                                        }
                                    }
                                }
                            }
                        }
                    });
                },

                updateCharts() {
                    if (this.trendChart) {
                        this.trendChart.data.datasets[0].data = this.trendChartData.data;
                        this.trendChart.update();
                    }
                    if (this.pieChart) {
                        this.pieChart.data.datasets[0].data = this.pieChartData.data;
                        this.pieChart.update();
                    }
                },

                // BACKEND CONNECTION: Apply filters and fetch new data
                async applyFilters() {
                    this.loading = true;
                    
                    try {
                        // Example API call to filter data:
                        // const response = await fetch('/api/admin/reports/filter', {
                        //     method: 'POST',
                        //     headers: { 'Content-Type': 'application/json' },
                        //     body: JSON.stringify(this.filters)
                        // });
                        // const data = await response.json();
                        // this.periodData = data.periodData;
                        // this.serviceData = data.serviceData;
                        
                        // Simulate API call
                        await new Promise(resolve => setTimeout(resolve, 1000));
                        
                        console.log('Filters applied:', this.filters);
                        this.updateCharts();
                    } catch (error) {
                        console.error('Error applying filters:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                resetFilters() {
                    this.filters = {
                        reportType: 'appointments',
                        timePeriod: '30',
                        startDate: '',
                        endDate: ''
                    };
                    this.applyFilters();
                },

                sortTable(column) {
                    if (this.sortBy === column) {
                        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortBy = column;
                        this.sortOrder = 'desc';
                    }
                },

                getSortIcon(column) {
                    if (this.sortBy !== column) return 'bi bi-sort';
                    return this.sortOrder === 'asc' ? 'bi bi-sort-up' : 'bi bi-sort-down';
                },

                sortServices(column) {
                    if (this.serviceSortBy === column) {
                        this.serviceSortOrder = this.serviceSortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.serviceSortBy = column;
                        this.serviceSortOrder = 'desc';
                    }
                },

                getServiceSortIcon(column) {
                    if (this.serviceSortBy !== column) return 'bi bi-sort';
                    return this.serviceSortOrder === 'asc' ? 'bi bi-sort-up' : 'bi bi-sort-down';
                },

                // BACKEND CONNECTION: Export report functionality
                exportReport() {
                    // Example: window.location.href = '/admin/reports/export?type=' + this.filters.reportType;
                    console.log('Exporting report...');
                    alert('Report export functionality - Connect to your backend export route');
                },

                exportTableData() {
                    console.log('Exporting table data...');
                    alert('Table data export - Connect to your backend');
                },

                viewServiceDetails() {
                    console.log('Viewing service details...');
                },

                generateCustomReport() {
                    console.log('Generating custom report...');
                    alert('Custom report generation - Connect to your backend');
                },

                printReport() {
                    window.print();
                },

                emailReport() {
                    console.log('Emailing report...');
                    alert('Email report functionality - Connect to your backend');
                }
            }
        }).mount('#reportsApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    In your Laravel Controller (e.g., AdminController.php):
    
    public function reports() {
        // Get report data
        $periodData = [
            ['period' => 'This Week', 'total' => 142, 'approved' => 118, ...],
            // ... more data
        ];
        
        $serviceData = Appointment::select('service_name', DB::raw('count(*) as count'))
            ->groupBy('service_name')
            ->get();
        
        $summary = [
            'total' => Appointment::count(),
            'approvalRate' => ...,
            'cancellationRate' => ...,
            'avgPerDay' => ...
        ];
        
        $trendChartData = [
            'labels' => ['Week 1', 'Week 2', ...],
            'data' => [142, 156, ...]
        ];
        
        return view('admin.reports', compact('periodData', 'serviceData', 'summary', 'trendChartData'));
    }
    
    Then in the Vue code, uncomment:
    this.periodData = @json($periodData);
    this.serviceData = @json($serviceData);
    this.summary = @json($summary);
    this.trendChartData = @json($trendChartData);
    
    ==========================================
    -->
</body>
</html>