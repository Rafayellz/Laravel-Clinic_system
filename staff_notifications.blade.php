<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Add Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
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
        
        .notification-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-item.unread {
            background-color: rgba(40, 167, 69, 0.05);
            border-left: 4px solid var(--primary-green);
            padding-left: 16px;
        }
        
        .notification-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .notification-date {
            color: #6c757d;
            font-size: 14px;
        }
        
        .notification-message {
            color: #495057;
            margin-bottom: 10px;
        }
        
        .badge-unread {
            background-color: var(--primary-green);
            color: white;
        }

        /* Vue.js specific styles */
        .filter-section {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .notification-type-badge {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            margin-right: 8px;
        }

        .notification-announcement {
            background-color: #d4edda;
            color: #155724;
        }

        .notification-system {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .notification-appointment {
            background-color: #fff3cd;
            color: #856404;
        }

        .notification-medicine {
            background-color: #d6d8d9;
            color: #383d41;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.3s;
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
            <a class="nav-link" href="{{ route('staff_reports') }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reports</span>
            </a>
            <a class="nav-link active" href="{{ route('staff_notifications') }}">
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <h4 class="mb-0">Notifications</h4>
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

        <!-- Vue.js App Container -->
        <div id="notificationsApp">
            <!-- Notifications Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Notifications</h2>
                <div>
                    <span class="badge bg-success">{{ unreadCount }} Unread</span>
                    <button @click="markAllAsRead" :disabled="unreadCount === 0" class="btn btn-sm btn-outline-success ms-2">
                        <i class="bi bi-check-all"></i> Mark All Read
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-funnel me-2"></i>Filter by Type</label>
                        <select v-model="filterType" class="form-select" @change="applyFilters">
                            <option value="all">All Types</option>
                            <option value="announcement">Announcements</option>
                            <option value="system">System</option>
                            <option value="appointment">Appointments</option>
                            <option value="medicine">Medicine</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-envelope me-2"></i>Filter by Status</label>
                        <select v-model="filterStatus" class="form-select" @change="applyFilters">
                            <option value="all">All</option>
                            <option value="unread">Unread Only</option>
                            <option value="read">Read Only</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-search me-2"></i>Search</label>
                        <input 
                            v-model="searchQuery" 
                            type="text" 
                            class="form-control" 
                            placeholder="Search notifications..."
                            @input="applyFilters">
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="loading-spinner">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Loading notifications...</p>
            </div>

            <!-- Notifications List -->
            <div v-if="!loading" class="card">
                <div class="card-body">
                    <!-- Empty State -->
                    <div v-if="filteredNotifications.length === 0" class="text-center py-5">
                        <i class="bi bi-bell-slash fa-3x text-muted mb-3"></i>
                        <h5>No Notifications</h5>
                        <p class="text-muted">You don't have any notifications matching your filters.</p>
                    </div>

                    <!-- Notification Items -->
                    <transition-group name="fade" tag="div" class="notification-list">
                        <div 
                            v-for="notification in filteredNotifications" 
                            :key="notification.id"
                            class="notification-item cursor-pointer"
                            :class="{ 'unread': !notification.read }"
                            @click="markAsRead(notification.id)">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="notification-title">
                                        <span :class="['notification-type-badge', 'notification-' + notification.type]">
                                            {{ getTypeLabel(notification.type) }}
                                        </span>
                                        {{ notification.title }}
                                        <span v-if="!notification.read" class="badge bg-danger ms-2" style="font-size: 0.65rem;">NEW</span>
                                    </div>
                                    <div class="notification-message">{{ notification.message }}</div>
                                    <div class="notification-date">
                                        <i class="bi bi-clock me-1"></i>{{ formatDate(notification.date) }}
                                    </div>
                                </div>
                                <div>
                                    <button v-if="!notification.read" @click.stop="markAsRead(notification.id)" class="btn btn-sm btn-outline-success">Mark as Read</button>
                                    <span v-else class="badge bg-secondary">Read</span>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    // BACKEND CONNECTION: Replace with Laravel data
                    // Example: notifications: @json($notifications),
                    notifications: [],
                    filteredNotifications: [],
                    filterType: 'all',
                    filterStatus: 'all',
                    searchQuery: '',
                    loading: false
                }
            },
            computed: {
                unreadCount() {
                    return this.notifications.filter(n => !n.read).length;
                }
            },
            mounted() {
                // BACKEND CONNECTION: Initialize notifications from Laravel
                this.loadNotifications();
                this.applyFilters();
            },
            methods: {
                // BACKEND CONNECTION: Replace this with actual API call to Laravel
                loadNotifications() {
                    this.loading = true;
                    
                    // Simulate API call delay
                    setTimeout(() => {
                        // BACKEND: Replace this with Laravel data
                        // this.notifications = @json($notifications);
                        
                        // Sample data for demonstration
                        this.notifications = [
                            {
                                id: 1,
                                type: 'announcement',
                                title: 'Clinic Holiday Schedule',
                                message: 'The clinic will be closed on December 25th and 26th for Christmas holidays. Please inform patients accordingly.',
                                date: '2023-12-10T08:00:00',
                                read: false
                            },
                            {
                                id: 2,
                                type: 'announcement',
                                title: 'New Health Alert: Flu Season',
                                message: 'Increased cases of influenza reported in the area. Please ensure proper hygiene protocols and encourage flu vaccinations.',
                                date: '2023-12-08T10:30:00',
                                read: false
                            },
                            {
                                id: 3,
                                type: 'announcement',
                                title: 'Updated Clinic Hours',
                                message: 'Starting January 1st, clinic hours will extend to 7 PM on weekdays to accommodate more patients.',
                                date: '2023-12-05T14:15:00',
                                read: false
                            },
                            {
                                id: 4,
                                type: 'system',
                                title: 'New Medical Supplies Arrived',
                                message: 'The latest shipment of medical supplies has arrived. Please check inventory and restock as needed.',
                                date: '2023-12-01T09:45:00',
                                read: true
                            },
                            {
                                id: 5,
                                type: 'appointment',
                                title: 'Staff Meeting Reminder',
                                message: 'Monthly staff meeting scheduled for Friday at 3 PM in the conference room. All staff members are required to attend.',
                                date: '2023-11-28T16:20:00',
                                read: true
                            },
                            {
                                id: 6,
                                type: 'system',
                                title: 'New Patient Portal Features',
                                message: 'The patient portal has been updated with new features. Please familiarize yourself with the changes.',
                                date: '2023-11-25T11:10:00',
                                read: true
                            },
                            {
                                id: 7,
                                type: 'medicine',
                                title: 'Medicine Inventory Alert',
                                message: 'Low stock alert: Paracetamol is running low. Please check inventory and place order if needed.',
                                date: '2023-11-20T13:25:00',
                                read: true
                            },
                            {
                                id: 8,
                                type: 'appointment',
                                title: 'Patient Appointment Update',
                                message: 'Patient John Doe has rescheduled their appointment from 2 PM to 4 PM today.',
                                date: '2023-11-18T08:50:00',
                                read: true
                            }
                        ];
                        
                        this.loading = false;
                        this.applyFilters();
                    }, 500);
                },

                applyFilters() {
                    let filtered = [...this.notifications];

                    // Filter by type
                    if (this.filterType !== 'all') {
                        filtered = filtered.filter(n => n.type === this.filterType);
                    }

                    // Filter by status
                    if (this.filterStatus === 'unread') {
                        filtered = filtered.filter(n => !n.read);
                    } else if (this.filterStatus === 'read') {
                        filtered = filtered.filter(n => n.read);
                    }

                    // Search filter
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(n => 
                            n.title.toLowerCase().includes(query) ||
                            n.message.toLowerCase().includes(query)
                        );
                    }

                    // Sort by date (newest first)
                    filtered.sort((a, b) => new Date(b.date) - new Date(a.date));

                    this.filteredNotifications = filtered;
                },

                // BACKEND CONNECTION: Mark notification as read
                markAsRead(notificationId) {
                    const notification = this.notifications.find(n => n.id === notificationId);
                    if (notification && !notification.read) {
                        notification.read = true;
                        
                        // Example API call to Laravel:
                        // fetch(`/api/staff/notifications/${notificationId}/read`, {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        //     }
                        // });
                        
                        console.log(`Marked notification ${notificationId} as read`);
                    }
                },

                // BACKEND CONNECTION: Mark all as read
                markAllAsRead() {
                    this.notifications.forEach(n => {
                        if (!n.read) {
                            n.read = true;
                        }
                    });
                    
                    // Example API call to Laravel:
                    // fetch('/api/staff/notifications/mark-all-read', {
                    //     method: 'POST',
                    //     headers: {
                    //         'Content-Type': 'application/json',
                    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    //     }
                    // });
                    
                    console.log('All notifications marked as read');
                },

                getTypeLabel(type) {
                    const labels = {
                        'announcement': 'Announcement',
                        'system': 'System',
                        'appointment': 'Appointment',
                        'medicine': 'Medicine'
                    };
                    return labels[type] || type;
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffTime = Math.abs(now - date);
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
                    const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
                    const diffMinutes = Math.floor(diffTime / (1000 * 60));

                    if (diffMinutes < 60) {
                        return `${diffMinutes} minute${diffMinutes !== 1 ? 's' : ''} ago`;
                    } else if (diffHours < 24) {
                        return `${diffHours} hour${diffHours !== 1 ? 's' : ''} ago`;
                    } else if (diffDays === 0) {
                        return 'Today, ' + date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                    } else if (diffDays === 1) {
                        return 'Yesterday, ' + date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                    } else if (diffDays < 7) {
                        return `${diffDays} days ago`;
                    } else {
                        return date.toLocaleDateString('en-US', { 
                            month: 'short', 
                            day: 'numeric', 
                            year: date.getFullYear() !== now.getFullYear() ? 'numeric' : undefined 
                        });
                    }
                }
            }
        }).mount('#notificationsApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    1. In your Laravel Controller (StaffNotificationController.php):
    
    public function index() {
        $notifications = Notification::where('user_id', auth()->id())
            ->where('user_type', 'staff')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'date' => $notification->created_at->toISOString(),
                    'read' => (bool)$notification->read_at
                ];
            });
        
        return view('staff.notifications', compact('notifications'));
    }
    
    2. Add API routes in routes/web.php or routes/api.php:
    
    // Mark as read
    Route::post('/staff/notifications/{id}/read', [StaffNotificationController::class, 'markAsRead']);
    
    // Mark all as read
    Route::post('/staff/notifications/mark-all-read', [StaffNotificationController::class, 'markAllAsRead']);
    
    3. In the Vue code above, uncomment and use:
    
    // Replace sample data with actual Laravel data
    this.notifications = @json($notifications);
    
    // Uncomment the fetch API calls in markAsRead() and markAllAsRead() methods
    
    ==========================================
    -->
</body>
</html>