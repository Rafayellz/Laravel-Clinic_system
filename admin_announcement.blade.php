<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement - DNSC Clinic</title>
    <!-- BACKEND: Add CSRF Token -->
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
        }
        
        .announcement-card {
            border-left: 4px solid var(--primary-green);
        }
        
        .announcement-date {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .filter-section {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .char-counter {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .char-counter.warning {
            color: #ffc107;
        }

        .char-counter.danger {
            color: #dc3545;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s;
        }

        .fade-enter-from, .fade-leave-to {
            opacity: 0;
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
            <a class="nav-link active" href="{{ route('admin_announcement') }}">
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
    <div class="main-content" id="announcementsApp">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Create Announcement</h4>
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

        <!-- Success/Error Messages -->
        <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ successMessage }}
            <button type="button" class="btn-close" @click="successMessage = ''"></button>
        </div>
        <div v-if="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ errorMessage }}
            <button type="button" class="btn-close" @click="errorMessage = ''"></button>
        </div>

        <!-- Create Announcement Form (Vue.js) -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    {{ editingId ? 'Edit Announcement' : 'Create New Announcement' }}
                </h5>
                <form @submit.prevent="submitAnnouncement">
                    <div class="mb-3">
                        <label for="announcementTitle" class="form-label">Title <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="announcementTitle"
                            v-model="form.title"
                            placeholder="Enter announcement title"
                            required
                            maxlength="200">
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Give your announcement a clear, descriptive title</small>
                            <small :class="['char-counter', { 'warning': form.title.length > 150, 'danger': form.title.length > 180 }]">
                                {{ form.title.length }}/200
                            </small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="announcementMessage" class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea 
                            class="form-control" 
                            id="announcementMessage" 
                            rows="5"
                            v-model="form.message"
                            placeholder="Enter announcement message"
                            required
                            maxlength="1000"></textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Provide detailed information about the announcement</small>
                            <small :class="['char-counter', { 'warning': form.message.length > 800, 'danger': form.message.length > 950 }]">
                                {{ form.message.length }}/1000
                            </small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success" :disabled="submitting">
                            <span v-if="!submitting">
                                <i class="bi bi-megaphone me-2"></i>
                                {{ editingId ? 'Update Announcement' : 'Publish Announcement' }}
                            </span>
                            <span v-else>
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Publishing...
                            </span>
                        </button>
                        <button v-if="editingId" type="button" class="btn btn-secondary" @click="cancelEdit">
                            <i class="bi bi-x me-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-filter me-2"></i>Filter by Status</label>
                    <select v-model="filterStatus" class="form-select" @change="applyFilters">
                        <option value="all">All Announcements</option>
                        <option value="active">Active</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Search</label>
                    <input 
                        v-model="searchQuery" 
                        type="text" 
                        class="form-control" 
                        placeholder="Search announcements..."
                        @input="applyFilters">
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-sort-down me-2"></i>Sort By</label>
                    <select v-model="sortBy" class="form-select" @change="sortAnnouncements">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="title">Title (A-Z)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading announcements...</p>
        </div>

        <!-- List of Announcements (Vue.js) -->
        <div v-if="!loading" class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    <span>Recent Announcements <span class="text-muted">({{ filteredAnnouncements.length }})</span></span>
                </h5>
                
                <!-- Empty State -->
                <div v-if="filteredAnnouncements.length === 0" class="text-center py-5">
                    <i class="bi bi-megaphone-fill fs-1 text-muted mb-3"></i>
                    <h5>No Announcements Found</h5>
                    <p class="text-muted">{{ announcements.length === 0 ? 'Create your first announcement above!' : 'Try adjusting your filters.' }}</p>
                </div>

                <!-- Announcements List -->
                <transition-group name="fade">
                    <div 
                        v-for="announcement in filteredAnnouncements" 
                        :key="announcement.id"
                        class="card announcement-card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ announcement.title }}</h5>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" @click="editAnnouncement(announcement)">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </button>
                                    <button 
                                        class="btn btn-sm"
                                        :class="announcement.status === 'active' ? 'btn-outline-secondary' : 'btn-outline-success'"
                                        @click="toggleStatus(announcement.id)">
                                        <i :class="announcement.status === 'active' ? 'bi bi-archive' : 'bi bi-arrow-counterclockwise'" class="me-1"></i>
                                        {{ announcement.status === 'active' ? 'Archive' : 'Restore' }}
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteAnnouncement(announcement.id)">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                            <p class="card-text">{{ announcement.message }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="announcement-date">
                                    <i class="bi bi-clock me-1"></i>{{ formatDate(announcement.created_at) }}
                                </small>
                                <span :class="['badge', announcement.status === 'active' ? 'bg-success' : 'bg-secondary']">
                                    {{ announcement.status === 'active' ? 'Active' : 'Archived' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </transition-group>
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
                    // announcements: @json($announcements),
                    announcements: [],
                    filteredAnnouncements: [],
                    form: {
                        title: '',
                        message: ''
                    },
                    editingId: null,
                    filterStatus: 'all',
                    searchQuery: '',
                    sortBy: 'newest',
                    loading: false,
                    submitting: false,
                    successMessage: '',
                    errorMessage: ''
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize from Laravel
                this.initializeFromBackend();
                this.applyFilters();
            },
            methods: {
                // BACKEND CONNECTION: Get announcements from Laravel
                initializeFromBackend() {
                    // Uncomment to use Laravel data:
                    // this.announcements = @json($announcements);
                    
                    // Sample data for demonstration
                    this.announcements = [
                        {
                            id: 1,
                            title: 'Flu Vaccination Campaign',
                            message: 'Annual flu vaccination is now available for all students and staff. Please visit the clinic during operating hours to get vaccinated.',
                            status: 'active',
                            created_at: new Date(Date.now() - 172800000).toISOString()
                        },
                        {
                            id: 2,
                            title: 'Clinic Hours Update',
                            message: 'The clinic will close early on Friday for staff training. We will be closing at 2:00 PM instead of the usual 5:00 PM.',
                            status: 'active',
                            created_at: new Date(Date.now() - 432000000).toISOString()
                        },
                        {
                            id: 3,
                            title: 'New Medical Equipment',
                            message: 'We have recently acquired new medical equipment to enhance our diagnostic capabilities. This includes a new digital X-ray machine and updated laboratory equipment.',
                            status: 'active',
                            created_at: new Date(Date.now() - 604800000).toISOString()
                        },
                        {
                            id: 4,
                            title: 'Summer Health Tips',
                            message: 'As summer approaches, remember to stay hydrated, use sunscreen, and protect yourself from heat-related illnesses. The clinic has free sunscreen samples available.',
                            status: 'archived',
                            created_at: new Date(Date.now() - 1209600000).toISOString()
                        }
                    ];
                },

                // BACKEND CONNECTION: Submit announcement
                async submitAnnouncement() {
                    if (!this.form.title.trim() || !this.form.message.trim()) {
                        this.errorMessage = 'Please fill in all required fields';
                        return;
                    }

                    this.submitting = true;
                    try {
                        // BACKEND: Uncomment to use Laravel route
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // formData.append('title', this.form.title);
                        // formData.append('message', this.form.message);
                        // 
                        // const url = this.editingId 
                        //     ? `/admin/announcements/${this.editingId}` 
                        //     : '/admin/announcements';
                        // const method = this.editingId ? 'PUT' : 'POST';
                        // 
                        // const response = await fetch(url, {
                        //     method: method,
                        //     body: formData
                        // });
                        // 
                        // if (response.ok) {
                        //     window.location.reload();
                        // }

                        // Demo version:
                        if (this.editingId) {
                            const announcement = this.announcements.find(a => a.id === this.editingId);
                            announcement.title = this.form.title;
                            announcement.message = this.form.message;
                            this.successMessage = 'Announcement updated successfully!';
                        } else {
                            this.announcements.unshift({
                                id: Date.now(),
                                title: this.form.title,
                                message: this.form.message,
                                status: 'active',
                                created_at: new Date().toISOString()
                            });
                            this.successMessage = 'Announcement published successfully!';
                        }

                        this.form.title = '';
                        this.form.message = '';
                        this.editingId = null;
                        this.applyFilters();
                    } catch (error) {
                        this.errorMessage = 'Failed to save announcement';
                        console.error(error);
                    } finally {
                        this.submitting = false;
                    }
                },

                editAnnouncement(announcement) {
                    this.form.title = announcement.title;
                    this.form.message = announcement.message;
                    this.editingId = announcement.id;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                cancelEdit() {
                    this.form.title = '';
                    this.form.message = '';
                    this.editingId = null;
                },

                // BACKEND CONNECTION: Toggle status
                async toggleStatus(id) {
                    // BACKEND: Uncomment to use Laravel route
                    // const formData = new FormData();
                    // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                    // await fetch(`/admin/announcements/${id}/toggle-status`, {
                    //     method: 'POST',
                    //     body: formData
                    // });

                    const announcement = this.announcements.find(a => a.id === id);
                    announcement.status = announcement.status === 'active' ? 'archived' : 'active';
                    this.applyFilters();
                },

                // BACKEND CONNECTION: Delete announcement
                async deleteAnnouncement(id) {
                    if (confirm('Are you sure you want to delete this announcement? This action cannot be undone.')) {
                        // BACKEND: Uncomment to use Laravel route
                        // const formData = new FormData();
                        // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                        // await fetch(`/admin/announcements/${id}`, {
                        //     method: 'DELETE',
                        //     body: formData
                        // });

                        const index = this.announcements.findIndex(a => a.id === id);
                        if (index !== -1) {
                            this.announcements.splice(index, 1);
                            this.successMessage = 'Announcement deleted successfully!';
                            this.applyFilters();
                        }
                    }
                },

                applyFilters() {
                    let filtered = [...this.announcements];

                    // Filter by status
                    if (this.filterStatus !== 'all') {
                        filtered = filtered.filter(a => a.status === this.filterStatus);
                    }

                    // Search filter
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(a => 
                            a.title.toLowerCase().includes(query) ||
                            a.message.toLowerCase().includes(query)
                        );
                    }

                    this.filteredAnnouncements = filtered;
                    this.sortAnnouncements();
                },

                sortAnnouncements() {
                    this.filteredAnnouncements.sort((a, b) => {
                        if (this.sortBy === 'newest') {
                            return new Date(b.created_at) - new Date(a.created_at);
                        } else if (this.sortBy === 'oldest') {
                            return new Date(a.created_at) - new Date(b.created_at);
                        } else if (this.sortBy === 'title') {
                            return a.title.localeCompare(b.title);
                        }
                    });
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffTime = Math.abs(now - date);
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays === 0) return 'Today';
                    if (diffDays === 1) return 'Yesterday';
                    if (diffDays < 7) return `${diffDays} days ago`;
                    if (diffDays < 30) return `${Math.floor(diffDays / 7)} weeks ago`;
                    return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                }
            }
        }).mount('#announcementsApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    1. Add CSRF token in <head> (already added above)
    
    2. In Laravel Controller:
       public function index() {
           $announcements = Announcement::orderBy('created_at', 'desc')->get();
           return view('admin.announcements', compact('announcements'));
       }
    
    3. Uncomment in Vue: this.announcements = @json($announcements);
    
    4. Create routes:
       Route::post('/admin/announcements', [AnnouncementController::class, 'store']);
       Route::put('/admin/announcements/{id}', [AnnouncementController::class, 'update']);
       Route::delete('/admin/announcements/{id}', [AnnouncementController::class, 'destroy']);
       Route::post('/admin/announcements/{id}/toggle-status', [AnnouncementController::class, 'toggleStatus']);
    
    ==========================================
    -->
</body>
</html>