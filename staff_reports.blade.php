<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Staff Reports</title>
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
        
        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 15px;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .filter-section {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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

    <!-- Main Content - Vue.js App -->
    <div class="main-content" id="reportsApp">
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
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Success/Error Messages -->
        <div v-if="successMessage" class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ successMessage }}
            <button type="button" class="btn-close" @click="successMessage = ''"></button>
        </div>

        <!-- Stats Summary -->
        <div class="stats-card">
            <div class="row">
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.totalReports }}</div>
                    <div class="stat-label">Total Reports</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.totalPatients }}</div>
                    <div class="stat-label">Total Patients</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.totalMedicines }}</div>
                    <div class="stat-label">Medicines Dispensed</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.avgPatientsPerDay }}</div>
                    <div class="stat-label">Avg Patients/Day</div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Weekly Overview</h5>
                <div class="chart-container">
                    <canvas ref="reportsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daily Clinic Reports</h2>
            <button class="btn btn-success" @click="openAddModal">
                <i class="bi bi-plus-circle me-2"></i>Add Report
            </button>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-calendar me-2"></i>Date Range</label>
                    <select v-model="dateRange" class="form-select" @change="applyFilters">
                        <option value="week">Last 7 Days</option>
                        <option value="month">Last 30 Days</option>
                        <option value="quarter">Last 3 Months</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Search</label>
                    <input v-model="searchQuery" type="text" class="form-control" placeholder="Search notes..." @input="applyFilters">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-outline-success w-100" @click="exportReports">
                        <i class="bi bi-download me-2"></i>Export Reports
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success"></div>
            <p class="mt-3 text-muted">Loading reports...</p>
        </div>

        <!-- Reports Table -->
        <div v-if="!loading" class="card">
            <div class="card-body">
                <h5 class="card-title">Daily Reports <span class="text-muted">({{ filteredReports.length }})</span></h5>
                
                <div v-if="filteredReports.length === 0" class="text-center py-5">
                    <i class="bi bi-file-earmark-text fs-1 text-muted mb-3"></i>
                    <h5>No Reports Found</h5>
                    <p class="text-muted">Add your first daily report above!</p>
                </div>

                <div v-else class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th @click="sortTable('date')" :class="{ active: sortBy === 'date' }">
                                    Date
                                    <i :class="getSortIcon('date')"></i>
                                </th>
                                <th @click="sortTable('patients')" :class="{ active: sortBy === 'patients' }">
                                    Total Patients
                                    <i :class="getSortIcon('patients')"></i>
                                </th>
                                <th @click="sortTable('medicines')" :class="{ active: sortBy === 'medicines' }">
                                    Medicines Dispensed
                                    <i :class="getSortIcon('medicines')"></i>
                                </th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="report in paginatedReports" :key="report.id">
                                <td><strong>{{ formatDate(report.date) }}</strong></td>
                                <td>{{ report.total_patients }}</td>
                                <td>{{ report.medicines_dispensed }}</td>
                                <td>{{ truncateText(report.notes, 50) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" @click="viewDetails(report)">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteReport(report.id)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav v-if="totalPages > 1">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">Previous</a>
                        </li>
                        <li v-for="page in visiblePages" :key="page" class="page-item" :class="{ active: page === currentPage }">
                            <a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Add Report Modal -->
        <div class="modal fade" id="addReportModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Daily Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" v-model="form.date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Patients <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model="form.total_patients" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Medicines Dispensed <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model="form.medicines_dispensed" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" v-model="form.notes" rows="3" maxlength="500"></textarea>
                            <small class="text-muted">{{ form.notes.length }}/500</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" @click="saveReport" :disabled="submitting">
                            <span v-if="!submitting">Save Report</span>
                            <span v-else><span class="spinner-border spinner-border-sm me-2"></span>Saving...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Details Modal -->
        <div class="modal fade" id="viewDetailsModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Report Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" v-if="selectedReport">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Date:</div>
                            <div class="col-sm-8">{{ formatDate(selectedReport.date) }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Total Patients:</div>
                            <div class="col-sm-8">{{ selectedReport.total_patients }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Medicines Dispensed:</div>
                            <div class="col-sm-8">{{ selectedReport.medicines_dispensed }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Notes:</div>
                            <div class="col-sm-8">{{ selectedReport.notes || 'No notes provided' }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Uncomment to use Laravel data
                    // reports: @json($reports),
                    reports: [],
                    filteredReports: [],
                    form: {
                        date: '',
                        total_patients: 0,
                        medicines_dispensed: 0,
                        notes: ''
                    },
                    selectedReport: null,
                    dateRange: 'week',
                    searchQuery: '',
                    sortBy: 'date',
                    sortOrder: 'desc',
                    loading: false,
                    submitting: false,
                    currentPage: 1,
                    itemsPerPage: 10,
                    successMessage: '',
                    addModal: null,
                    detailsModal: null,
                    reportsChart: null
                }
            },
            computed: {
                stats() {
                    return {
                        totalReports: this.reports.length,
                        totalPatients: this.reports.reduce((sum, r) => sum + parseInt(r.total_patients), 0),
                        totalMedicines: this.reports.reduce((sum, r) => sum + parseInt(r.medicines_dispensed), 0),
                        avgPatientsPerDay: this.reports.length > 0 
                            ? Math.round(this.reports.reduce((sum, r) => sum + parseInt(r.total_patients), 0) / this.reports.length)
                            : 0
                    };
                },
                totalPages() {
                    return Math.ceil(this.filteredReports.length / this.itemsPerPage);
                },
                paginatedReports() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredReports.slice(start, start + this.itemsPerPage);
                },
                visiblePages() {
                    const pages = [];
                    const maxVisible = 5;
                    let start = Math.max(1, this.currentPage - 2);
                    let end = Math.min(this.totalPages, start + maxVisible - 1);
                    if (end - start + 1 < maxVisible) start = Math.max(1, end - maxVisible + 1);
                    for (let i = start; i <= end; i++) pages.push(i);
                    return pages;
                }
            },
            mounted() {
                this.initializeFromBackend();
                this.applyFilters();
                this.addModal = new bootstrap.Modal(document.getElementById('addReportModal'));
                this.detailsModal = new bootstrap.Modal(document.getElementById('viewDetailsModal'));
                this.$nextTick(() => this.initChart());
            },
            methods: {
                // BACKEND CONNECTION: Initialize from Laravel
                initializeFromBackend() {
                    // Uncomment: this.reports = @json($reports);
                    
                    // Sample data
                    this.reports = [
                        { id: 1, date: '2023-10-15', total_patients: 24, medicines_dispensed: 18, notes: 'Regular checkups and vaccinations' },
                        { id: 2, date: '2023-10-14', total_patients: 19, medicines_dispensed: 15, notes: 'Mostly follow-up appointments' },
                        { id: 3, date: '2023-10-13', total_patients: 22, medicines_dispensed: 20, notes: 'High demand for flu vaccines' },
                        { id: 4, date: '2023-10-12', total_patients: 17, medicines_dispensed: 12, notes: 'Quiet day, routine appointments' },
                        { id: 5, date: '2023-10-11', total_patients: 28, medicines_dispensed: 25, notes: 'Busy day with many walk-in patients' }
                    ];
                },

                initChart() {
                    const ctx = this.$refs.reportsChart;
                    if (!ctx) return;

                    const chartData = this.reports.slice(0, 7).reverse();
                    
                    this.reportsChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartData.map(r => this.formatDate(r.date)),
                            datasets: [
                                {
                                    label: 'Patients',
                                    data: chartData.map(r => r.total_patients),
                                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                    borderColor: 'rgba(40, 167, 69, 1)',
                                    borderWidth: 2,
                                    borderRadius: 5
                                },
                                {
                                    label: 'Medicines',
                                    data: chartData.map(r => r.medicines_dispensed),
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
                                legend: { position: 'top' }
                            },
                            scales: {
                                y: { beginAtZero: true },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                },

                applyFilters() {
                    let filtered = [...this.reports];

                    if (this.searchQuery.trim()) {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(r => r.notes.toLowerCase().includes(query));
                    }

                    this.filteredReports = filtered;
                    this.sortReports();
                    this.currentPage = 1;
                },

                sortTable(column) {
                    if (this.sortBy === column) {
                        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortBy = column;
                        this.sortOrder = 'desc';
                    }
                    this.sortReports();
                },

                sortReports() {
                    this.filteredReports.sort((a, b) => {
                        let compareA = this.sortBy === 'date' ? new Date(a.date) : a[this.sortBy];
                        let compareB = this.sortBy === 'date' ? new Date(b.date) : b[this.sortBy];
                        
                        if (compareA < compareB) return this.sortOrder === 'asc' ? -1 : 1;
                        if (compareA > compareB) return this.sortOrder === 'asc' ? 1 : -1;
                        return 0;
                    });
                },

                getSortIcon(column) {
                    if (this.sortBy !== column) return 'bi bi-sort';
                    return this.sortOrder === 'asc' ? 'bi bi-sort-up' : 'bi bi-sort-down';
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.currentPage = page;
                },

                openAddModal() {
                    this.form = { date: new Date().toISOString().split('T')[0], total_patients: 0, medicines_dispensed: 0, notes: '' };
                    this.addModal.show();
                },

                // BACKEND CONNECTION: Save report
                async saveReport() {
                    if (!this.form.date) {
                        alert('Please fill all required fields');
                        return;
                    }

                    this.submitting = true;
                    try {
                        // BACKEND: Uncomment to use Laravel
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // formData.append('date', this.form.date);
                        // formData.append('total_patients', this.form.total_patients);
                        // formData.append('medicines_dispensed', this.form.medicines_dispensed);
                        // formData.append('notes', this.form.notes);
                        // await fetch('/staff/reports', { method: 'POST', body: formData });

                        this.reports.unshift({
                            id: Date.now(),
                            ...this.form
                        });
                        
                        this.successMessage = 'Report saved successfully!';
                        this.addModal.hide();
                        this.applyFilters();
                        if (this.reportsChart) this.reportsChart.destroy();
                        this.$nextTick(() => this.initChart());
                    } catch (error) {
                        alert('Failed to save report');
                    } finally {
                        this.submitting = false;
                    }
                },

                viewDetails(report) {
                    this.selectedReport = report;
                    this.detailsModal.show();
                },

                // BACKEND CONNECTION: Delete report
                async deleteReport(id) {
                    if (confirm('Are you sure you want to delete this report?')) {
                        // BACKEND: Uncomment
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // await fetch(`/staff/reports/${id}`, { method: 'DELETE', body: formData });

                        const index = this.reports.findIndex(r => r.id === id);
                        if (index !== -1) {
                            this.reports.splice(index, 1);
                            this.successMessage = 'Report deleted successfully!';
                            this.applyFilters();
                        }
                    }
                },

                exportReports() {
                    alert('Export functionality - Connect to backend');
                },

                formatDate(dateString) {
                    return new Date(dateString).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                },

                truncateText(text, length) {
                    return text && text.length > length ? text.substring(0, length) + '...' : text;
                }
            }
        }).mount('#reportsApp');
    </script>

    <!-- 
    BACKEND CONNECTION:
    1. Uncomment: this.reports = @json($reports);
    2. Routes needed:
       POST /staff/reports - Create
       DELETE /staff/reports/{id} - Delete
    -->
</body>
</html>