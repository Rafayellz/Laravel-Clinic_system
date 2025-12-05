<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Medicine Inventory</title>
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

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .stats-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 8px;
            margin: 5px;
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
            <a class="nav-link active" href="{{ route('staff_inventory_medicine') }}">
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
    <div class="main-content" id="inventoryApp">
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
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Success/Error Messages -->
        <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ successMessage }}
            <button type="button" class="btn-close" @click="successMessage = ''"></button>
        </div>
        <div v-if="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ errorMessage }}
            <button type="button" class="btn-close" @click="errorMessage = ''"></button>
        </div>

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

        <!-- Stats Summary -->
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="mb-3">Inventory Summary</h6>
                <div class="d-flex flex-wrap">
                    <span class="stats-badge bg-success text-white">
                        <i class="bi bi-check-circle me-1"></i>Normal: <strong>{{ stats.normal }}</strong>
                    </span>
                    <span class="stats-badge bg-warning text-dark">
                        <i class="bi bi-exclamation-triangle me-1"></i>Low Stock: <strong>{{ stats.lowStock }}</strong>
                    </span>
                    <span class="stats-badge bg-danger text-white">
                        <i class="bi bi-x-circle me-1"></i>Expired: <strong>{{ stats.expired }}</strong>
                    </span>
                    <span class="stats-badge bg-secondary text-white">
                        <i class="bi bi-capsule me-1"></i>Total Items: <strong>{{ stats.total }}</strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Medicine Actions</h5>
                <div class="action-buttons d-flex flex-wrap">
                    <button class="btn btn-success" @click="openAddModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Medicine
                    </button>
                    <button class="btn btn-outline-success" @click="openUpdateStockModal">
                        <i class="bi bi-arrow-repeat me-2"></i>Update Stock
                    </button>
                    <button class="btn btn-outline-info" @click="exportInventory">
                        <i class="bi bi-download me-2"></i>Export Inventory
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label"><i class="bi bi-filter me-2"></i>Filter by Status</label>
                    <select v-model="filterStatus" class="form-select" @change="applyFilters">
                        <option value="all">All Status</option>
                        <option value="normal">Normal</option>
                        <option value="low">Low Stock</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label"><i class="bi bi-tag me-2"></i>Filter by Category</label>
                    <select v-model="filterCategory" class="form-select" @change="applyFilters">
                        <option value="all">All Categories</option>
                        <option value="Pain Relief">Pain Relief</option>
                        <option value="Antibiotic">Antibiotic</option>
                        <option value="Supplement">Supplement</option>
                        <option value="Allergy">Allergy</option>
                        <option value="Antacid">Antacid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Search</label>
                    <input 
                        v-model="searchQuery" 
                        type="text" 
                        class="form-control" 
                        placeholder="Search medicine..."
                        @input="applyFilters">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-outline-secondary w-100" @click="resetFilters">
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
            <p class="mt-3 text-muted">Loading inventory...</p>
        </div>

        <!-- Medicine Inventory Table -->
        <div v-if="!loading" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Medicine Inventory <span class="text-muted">({{ filteredMedicines.length }} items)</span>
                </h5>
                
                <!-- Empty State -->
                <div v-if="filteredMedicines.length === 0" class="text-center py-5">
                    <i class="bi bi-capsule fs-1 text-muted mb-3"></i>
                    <h5>No Medicines Found</h5>
                    <p class="text-muted">{{ medicines.length === 0 ? 'Add your first medicine above!' : 'Try adjusting your filters.' }}</p>
                </div>

                <!-- Table -->
                <div v-else class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th @click="sortTable('id')" :class="{ active: sortBy === 'id' }">
                                    Medicine ID
                                    <i :class="getSortIcon('id')"></i>
                                </th>
                                <th @click="sortTable('name')" :class="{ active: sortBy === 'name' }">
                                    Medicine Name
                                    <i :class="getSortIcon('name')"></i>
                                </th>
                                <th>Category</th>
                                <th @click="sortTable('stock')" :class="{ active: sortBy === 'stock' }">
                                    Stock
                                    <i :class="getSortIcon('stock')"></i>
                                </th>
                                <th @click="sortTable('expiry')" :class="{ active: sortBy === 'expiry' }">
                                    Expiry Date
                                    <i :class="getSortIcon('expiry')"></i>
                                </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="medicine in paginatedMedicines" :key="medicine.id">
                                <td><strong>{{ medicine.id }}</strong></td>
                                <td>{{ medicine.name }}</td>
                                <td>{{ medicine.category }}</td>
                                <td>
                                    <strong :class="getStockColor(medicine.stock, medicine.status)">
                                        {{ medicine.stock }}
                                    </strong>
                                </td>
                                <td>{{ formatDate(medicine.expiry_date) }}</td>
                                <td>
                                    <span :class="getStatusBadge(medicine.status)">
                                        {{ medicine.status }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" @click="editMedicine(medicine)">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteMedicine(medicine.id)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav v-if="totalPages > 1" aria-label="Medicine inventory pagination">
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

        <!-- Add/Edit Medicine Modal -->
        <div class="modal fade" id="medicineModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editingId ? 'Edit Medicine' : 'Add New Medicine' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Medicine Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="form.name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="form.category" required>
                                <option value="">Select Category</option>
                                <option value="Pain Relief">Pain Relief</option>
                                <option value="Antibiotic">Antibiotic</option>
                                <option value="Supplement">Supplement</option>
                                <option value="Allergy">Allergy</option>
                                <option value="Antacid">Antacid</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Initial Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" v-model="form.stock" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" v-model="form.expiry_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" @click="saveMedicine" :disabled="submitting">
                            <span v-if="!submitting">{{ editingId ? 'Update' : 'Add' }} Medicine</span>
                            <span v-else><span class="spinner-border spinner-border-sm me-2"></span>Saving...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Stock Modal -->
        <div class="modal fade" id="updateStockModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Medicine Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Medicine</label>
                            <select class="form-select" v-model="stockUpdate.medicineId">
                                <option value="">Select Medicine</option>
                                <option v-for="med in medicines" :key="med.id" :value="med.id">
                                    {{ med.name }} (Current: {{ med.stock }})
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock Change</label>
                            <input type="number" class="form-control" v-model="stockUpdate.change">
                            <div class="form-text">Enter positive number to add stock, negative to remove.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason</label>
                            <textarea class="form-control" v-model="stockUpdate.reason" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" @click="updateStock">Update Stock</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vue.js 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Uncomment to use Laravel data
                    // medicines: @json($medicines),
                    medicines: [],
                    filteredMedicines: [],
                    form: {
                        name: '',
                        category: '',
                        stock: 0,
                        expiry_date: ''
                    },
                    stockUpdate: {
                        medicineId: '',
                        change: 0,
                        reason: ''
                    },
                    editingId: null,
                    filterStatus: 'all',
                    filterCategory: 'all',
                    searchQuery: '',
                    sortBy: 'id',
                    sortOrder: 'asc',
                    loading: false,
                    submitting: false,
                    currentPage: 1,
                    itemsPerPage: 10,
                    successMessage: '',
                    errorMessage: '',
                    medicineModal: null,
                    updateStockModalInstance: null
                }
            },
            computed: {
                stats() {
                    return {
                        total: this.medicines.length,
                        normal: this.medicines.filter(m => m.status === 'Normal').length,
                        lowStock: this.medicines.filter(m => m.status === 'Low Stock').length,
                        expired: this.medicines.filter(m => m.status === 'Expired').length
                    };
                },
                totalPages() {
                    return Math.ceil(this.filteredMedicines.length / this.itemsPerPage);
                },
                paginatedMedicines() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredMedicines.slice(start, start + this.itemsPerPage);
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
                // BACKEND CONNECTION: Initialize from Laravel
                this.initializeFromBackend();
                this.applyFilters();
                
                // Initialize Bootstrap modals
                this.medicineModal = new bootstrap.Modal(document.getElementById('medicineModal'));
                this.updateStockModalInstance = new bootstrap.Modal(document.getElementById('updateStockModal'));
            },
            methods: {
                // BACKEND CONNECTION: Get data from Laravel
                initializeFromBackend() {
                    // Uncomment to use Laravel data:
                    // this.medicines = @json($medicines);
                    
                    // Sample data
                    this.medicines = [
                        { id: '001', name: 'Paracetamol 500mg', category: 'Pain Relief', stock: 125, expiry_date: '2024-05-15', status: 'Normal' },
                        { id: '002', name: 'Amoxicillin 250mg', category: 'Antibiotic', stock: 42, expiry_date: '2024-03-20', status: 'Low Stock' },
                        { id: '003', name: 'Vitamin C 100mg', category: 'Supplement', stock: 89, expiry_date: '2024-08-10', status: 'Normal' },
                        { id: '004', name: 'Ibuprofen 400mg', category: 'Pain Relief', stock: 15, expiry_date: '2024-02-28', status: 'Expired' },
                        { id: '005', name: 'Cetirizine 10mg', category: 'Allergy', stock: 67, expiry_date: '2024-11-05', status: 'Normal' },
                        { id: '006', name: 'Omeprazole 20mg', category: 'Antacid', stock: 32, expiry_date: '2023-12-01', status: 'Expired' }
                    ];
                },

                applyFilters() {
                    let filtered = [...this.medicines];

                    if (this.filterStatus !== 'all') {
                        const statusMap = {
                            'normal': 'Normal',
                            'low': 'Low Stock',
                            'expired': 'Expired'
                        };
                        filtered = filtered.filter(m => m.status === statusMap[this.filterStatus]);
                    }

                    if (this.filterCategory !== 'all') {
                        filtered = filtered.filter(m => m.category === this.filterCategory);
                    }

                    if (this.searchQuery.trim()) {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(m => 
                            m.name.toLowerCase().includes(query) ||
                            m.id.toLowerCase().includes(query)
                        );
                    }

                    this.filteredMedicines = filtered;
                    this.sortMedicines();
                    this.currentPage = 1;
                },

                resetFilters() {
                    this.filterStatus = 'all';
                    this.filterCategory = 'all';
                    this.searchQuery = '';
                    this.applyFilters();
                },

                sortTable(column) {
                    if (this.sortBy === column) {
                        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortBy = column;
                        this.sortOrder = 'asc';
                    }
                    this.sortMedicines();
                },

                sortMedicines() {
                    this.filteredMedicines.sort((a, b) => {
                        let compareA = a[this.sortBy];
                        let compareB = b[this.sortBy];

                        if (this.sortBy === 'stock') {
                            compareA = parseInt(compareA);
                            compareB = parseInt(compareB);
                        } else if (this.sortBy === 'expiry') {
                            compareA = new Date(a.expiry_date);
                            compareB = new Date(b.expiry_date);
                        } else if (typeof compareA === 'string') {
                            compareA = compareA.toLowerCase();
                            compareB = compareB.toLowerCase();
                        }
                        
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
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                openAddModal() {
                    this.editingId = null;
                    this.form = { name: '', category: '', stock: 0, expiry_date: '' };
                    this.medicineModal.show();
                },

                editMedicine(medicine) {
                    this.editingId = medicine.id;
                    this.form = { ...medicine };
                    this.medicineModal.show();
                },

                // BACKEND CONNECTION: Save medicine
                async saveMedicine() {
                    if (!this.form.name || !this.form.category || !this.form.expiry_date) {
                        this.errorMessage = 'Please fill all required fields';
                        return;
                    }

                    this.submitting = true;
                    try {
                        // BACKEND: Uncomment to use Laravel route
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // formData.append('name', this.form.name);
                        // formData.append('category', this.form.category);
                        // formData.append('stock', this.form.stock);
                        // formData.append('expiry_date', this.form.expiry_date);
                        // 
                        // const url = this.editingId 
                        //     ? `/staff/medicines/${this.editingId}` 
                        //     : '/staff/medicines';
                        // const method = this.editingId ? 'PUT' : 'POST';
                        // 
                        // const response = await fetch(url, { method, body: formData });
                        // if (response.ok) window.location.reload();

                        // Demo version:
                        if (this.editingId) {
                            const med = this.medicines.find(m => m.id === this.editingId);
                            Object.assign(med, this.form);
                            this.successMessage = 'Medicine updated successfully!';
                        } else {
                            this.medicines.push({
                                id: String(this.medicines.length + 1).padStart(3, '0'),
                                ...this.form,
                                status: 'Normal'
                            });
                            this.successMessage = 'Medicine added successfully!';
                        }
                        
                        this.medicineModal.hide();
                        this.applyFilters();
                    } catch (error) {
                        this.errorMessage = 'Failed to save medicine';
                    } finally {
                        this.submitting = false;
                    }
                },

                // BACKEND CONNECTION: Delete medicine
                async deleteMedicine(id) {
                    if (confirm('Are you sure you want to delete this medicine?')) {
                        // BACKEND: Uncomment to use Laravel route
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // await fetch(`/staff/medicines/${id}`, { method: 'DELETE', body: formData });

                        const index = this.medicines.findIndex(m => m.id === id);
                        if (index !== -1) {
                            this.medicines.splice(index, 1);
                            this.successMessage = 'Medicine deleted successfully!';
                            this.applyFilters();
                        }
                    }
                },

                openUpdateStockModal() {
                    this.stockUpdate = { medicineId: '', change: 0, reason: '' };
                    this.updateStockModalInstance.show();
                },

                // BACKEND CONNECTION: Update stock
                async updateStock() {
                    if (!this.stockUpdate.medicineId) {
                        this.errorMessage = 'Please select a medicine';
                        return;
                    }

                    // BACKEND: Uncomment to use Laravel route
                    // const formData = new FormData();
                    // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                    // formData.append('change', this.stockUpdate.change);
                    // formData.append('reason', this.stockUpdate.reason);
                    // await fetch(`/staff/medicines/${this.stockUpdate.medicineId}/update-stock`, {
                    //     method: 'POST',
                    //     body: formData
                    // });

                    const med = this.medicines.find(m => m.id === this.stockUpdate.medicineId);
                    if (med) {
                        med.stock = parseInt(med.stock) + parseInt(this.stockUpdate.change);
                        this.successMessage = 'Stock updated successfully!';
                        this.updateStockModalInstance.hide();
                        this.applyFilters();
                    }
                },

                exportInventory() {
                    console.log('Exporting inventory...');
                    alert('Export functionality - Connect to your backend');
                },

                getStatusBadge(status) {
                    const badges = {
                        'Normal': 'badge badge-normal',
                        'Low Stock': 'badge badge-low',
                        'Expired': 'badge badge-expired'
                    };
                    return badges[status] || 'badge bg-secondary';
                },

                getStockColor(stock, status) {
                    if (status === 'Expired') return 'text-danger';
                    if (status === 'Low Stock') return 'text-warning';
                    return 'text-success';
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                }
            }
        }).mount('#inventoryApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    1. In Laravel Controller (StaffController.php):
    
    public function inventoryMedicine() {
        $medicines = Medicine::all()->map(function($med) {
            return [
                'id' => str_pad($med->id, 3, '0', STR_PAD_LEFT),
                'name' => $med->name,
                'category' => $med->category,
                'stock' => $med->stock,
                'expiry_date' => $med->expiry_date,
                'status' => $med->status
            ];
        });
        return view('staff.inventory', compact('medicines'));
    }
    
    2. Uncomment in Vue: this.medicines = @json($medicines);
    
    3. Create routes:
    Route::post('/staff/medicines', [MedicineController::class, 'store']);
    Route::put('/staff/medicines/{id}', [MedicineController::class, 'update']);
    Route::delete('/staff/medicines/{id}', [MedicineController::class, 'destroy']);
    Route::post('/staff/medicines/{id}/update-stock', [MedicineController::class, 'updateStock']);
    
    ==========================================
    -->
</body>
</html>