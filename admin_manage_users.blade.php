<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Manage Users</title>
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
        
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
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

        .animate-row {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
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
            <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC Logo" class="img-fluid">
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
            <a class="nav-link active" href="{{ route('admin_manage_users') }}">
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
    <div class="main-content" id="usersApp">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Manage Users</h4>
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

        <!-- Stats Cards -->
        <div class="stats-card">
            <div class="row">
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.total }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.doctors }}</div>
                    <div class="stat-label">Doctors</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.nurses }}</div>
                    <div class="stat-label">Nurses</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="stat-number">{{ stats.admins }}</div>
                    <div class="stat-label">Administrators</div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>User Management</h2>
            <button class="btn btn-success" @click="addNewUser">
                <i class="bi bi-person-plus me-2"></i>Add New User
            </button>
        </div>

        <!-- Filter Section (Vue.js) -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-filter me-2"></i>Filter by Role</label>
                    <select v-model="filterRole" class="form-select" @change="applyFilters">
                        <option value="">All Roles</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Receptionist">Receptionist</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-building me-2"></i>Filter by Department</label>
                    <select v-model="filterDepartment" class="form-select" @change="applyFilters">
                        <option value="">All Departments</option>
                        <option value="General Medicine">General Medicine</option>
                        <option value="Dental">Dental</option>
                        <option value="Emergency">Emergency</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Administration">Administration</option>
                        <option value="Front Desk">Front Desk</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Search User</label>
                    <input 
                        v-model="searchQuery" 
                        type="text" 
                        class="form-control" 
                        placeholder="Search by name or ID..."
                        @input="applyFilters">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-end">
                    <button class="btn btn-outline-secondary" @click="resetFilters">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filters
                    </button>
                    <button class="btn btn-outline-success" @click="exportUsers">
                        <i class="bi bi-download me-2"></i>Export Users
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading users...</p>
        </div>

        <!-- Users Table (Vue.js) -->
        <div v-if="!loading" class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    Users List <span class="text-muted">({{ filteredUsers.length }} users)</span>
                </h5>

                <!-- Empty State -->
                <div v-if="filteredUsers.length === 0" class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No users found matching your filters.
                </div>

                <!-- Table -->
                <div v-else class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th @click="sortTable('user_id')" :class="{ active: sortBy === 'user_id' }">
                                    User ID
                                    <i :class="getSortIcon('user_id')"></i>
                                </th>
                                <th @click="sortTable('name')" :class="{ active: sortBy === 'name' }">
                                    Name
                                    <i :class="getSortIcon('name')"></i>
                                </th>
                                <th @click="sortTable('role')" :class="{ active: sortBy === 'role' }">
                                    Role
                                    <i :class="getSortIcon('role')"></i>
                                </th>
                                <th @click="sortTable('department')" :class="{ active: sortBy === 'department' }">
                                    Department
                                    <i :class="getSortIcon('department')"></i>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in paginatedUsers" :key="user.user_id" class="animate-row">
                                <td><strong>{{ user.user_id }}</strong></td>
                                <td>{{ user.name }}</td>
                                <td>
                                    <span :class="getRoleBadgeClass(user.role)">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td>{{ user.department }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-action" @click="editUser(user.user_id)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-action" @click="deleteUser(user.user_id)">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                    <button class="btn btn-sm btn-info btn-action" @click="viewUser(user.user_id)">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination (Vue.js) -->
                <nav v-if="totalPages > 1" aria-label="User pagination">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vue.js 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Replace with Laravel data
                    // Example: users: @json($users),
                    users: [],
                    filteredUsers: [],
                    filterRole: '',
                    filterDepartment: '',
                    searchQuery: '',
                    sortBy: 'user_id',
                    sortOrder: 'asc',
                    loading: false,
                    currentPage: 1,
                    itemsPerPage: 10,
                    stats: {
                        total: 0,
                        doctors: 0,
                        nurses: 0,
                        admins: 0
                    }
                }
            },
            computed: {
                totalPages() {
                    return Math.ceil(this.filteredUsers.length / this.itemsPerPage);
                },
                paginatedUsers() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredUsers.slice(start, end);
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
                // BACKEND CONNECTION: Initialize users from Laravel
                this.initializeFromBackend();
                this.applyFilters();
                this.calculateStats();
            },
            methods: {
                // BACKEND CONNECTION: Get users from Laravel controller
                initializeFromBackend() {
                    // Replace with actual backend data:
                    // this.users = @json($users);
                    
                    // Sample data for demonstration
                    this.users = [
                        { user_id: 'USR001', name: 'Dr. Maria Santos', role: 'Doctor', department: 'General Medicine' },
                        { user_id: 'USR002', name: 'Nurse John Reyes', role: 'Nurse', department: 'Emergency' },
                        { user_id: 'USR003', name: 'Admin User', role: 'Administrator', department: 'Administration' },
                        { user_id: 'USR004', name: 'Dr. Robert Lim', role: 'Doctor', department: 'Dental' },
                        { user_id: 'USR005', name: 'Nurse Sarah Tan', role: 'Nurse', department: 'Pediatrics' },
                        { user_id: 'USR006', name: 'Receptionist Anna Cruz', role: 'Receptionist', department: 'Front Desk' },
                        { user_id: 'USR007', name: 'Dr. James Wilson', role: 'Doctor', department: 'General Medicine' },
                        { user_id: 'USR008', name: 'Nurse Emma Brown', role: 'Nurse', department: 'Emergency' }
                    ];
                },

                applyFilters() {
                    let filtered = [...this.users];

                    // Filter by role
                    if (this.filterRole) {
                        filtered = filtered.filter(u => u.role === this.filterRole);
                    }

                    // Filter by department
                    if (this.filterDepartment) {
                        filtered = filtered.filter(u => u.department === this.filterDepartment);
                    }

                    // Search filter
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(u => 
                            u.name.toLowerCase().includes(query) ||
                            u.user_id.toLowerCase().includes(query) ||
                            u.role.toLowerCase().includes(query) ||
                            u.department.toLowerCase().includes(query)
                        );
                    }

                    this.filteredUsers = filtered;
                    this.sortUsers();
                    this.currentPage = 1;
                },

                resetFilters() {
                    this.filterRole = '';
                    this.filterDepartment = '';
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
                    this.sortUsers();
                },

                sortUsers() {
                    this.filteredUsers.sort((a, b) => {
                        let compareA = a[this.sortBy];
                        let compareB = b[this.sortBy];

                        if (typeof compareA === 'string') {
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

                calculateStats() {
                    this.stats = {
                        total: this.users.length,
                        doctors: this.users.filter(u => u.role === 'Doctor').length,
                        nurses: this.users.filter(u => u.role === 'Nurse').length,
                        admins: this.users.filter(u => u.role === 'Administrator').length
                    };
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                getRoleBadgeClass(role) {
                    const classes = {
                        'Doctor': 'badge bg-primary',
                        'Nurse': 'badge bg-info',
                        'Administrator': 'badge bg-success',
                        'Receptionist': 'badge bg-secondary'
                    };
                    return classes[role] || 'badge bg-secondary';
                },

                // BACKEND CONNECTION: Add new user
                addNewUser() {
                    window.location.href = '/admin/users/add';
                },

                // BACKEND CONNECTION: Edit user
                editUser(userId) {
                    window.location.href = `/admin/users/${userId}/edit`;
                },

                // BACKEND CONNECTION: Delete user
                async deleteUser(userId) {
                    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                        // Example API call:
                        // const response = await fetch(`/admin/users/${userId}`, { method: 'DELETE' });
                        
                        const index = this.users.findIndex(u => u.user_id === userId);
                        if (index !== -1) {
                            this.users.splice(index, 1);
                            this.applyFilters();
                            this.calculateStats();
                        }
                        console.log('Deleted user:', userId);
                    }
                },

                // BACKEND CONNECTION: View user details
                viewUser(userId) {
                    window.location.href = `/admin/users/${userId}`;
                },

                exportUsers() {
                    console.log('Exporting users...');
                    alert('Export functionality - Connect to your backend to generate CSV/Excel');
                }
            }
        }).mount('#usersApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    In your Laravel Controller (e.g., AdminController.php):
    
    public function manageUsers() {
        $users = User::all()->map(function($user) {
            return [
                'user_id' => 'USR' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                'name' => $user->first_name . ' ' . $user->last_name,
                'role' => $user->role,
                'department' => $user->department
            ];
        });
        
        return view('admin.manage-users', compact('users'));
    }
    
    Then in the Vue code, uncomment:
    this.users = @json($users);
    
    Create routes for CRUD operations:
    Route::get('/admin/users/add', [UserController::class, 'create']);
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit']);
    Route::get('/admin/users/{id}', [UserController::class, 'show']);
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
    
    ==========================================
    -->
</body>
</html>