<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - Notifications</title>
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
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
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
        
        .notification-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
            padding-left: 10px;
            margin-left: -10px;
            margin-right: -10px;
            padding-right: 10px;
        }

        .notification-item.unread {
            background-color: #f0f8ff;
        }
        
        .notification-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        
        .notification-announcement {
            color: #ffc107;
        }
        
        .notification-system {
            color: #17a2b8;
        }
        
        .notification-reminder {
            color: #28a745;
        }

        .filter-section {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .unread-badge {
            background-color: #dc3545;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 8px;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s;
        }

        .fade-enter-from, .fade-leave-to {
            opacity: 0;
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
            <a class="navbar-brand" href="#">
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
                            <i class="fas fa-user-circle"></i> {{ $user->first_name }} {{ $user->last_name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.html"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
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
                            <a class="nav-link" href="{{ route('myappointment') }}">
                                <i class="fas fa-calendar-check"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('diagnosis') }}">
                                <i class="fas fa-file-medical"></i> Diagnosis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('notifications') }}">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content - Vue.js App -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4" id="notificationsApp">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        Notifications
                        <span v-if="unreadCount > 0" class="unread-badge">{{ unreadCount }} new</span>
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" @click="markAllAsRead" :disabled="unreadCount === 0">
                                <i class="fas fa-check-double me-1"></i>Mark All as Read
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" @click="deleteAll">
                                <i class="fas fa-trash me-1"></i>Clear All
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Section (Vue.js) -->
                <div class="filter-section">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-filter me-2"></i>Filter by Type</label>
                            <select v-model="filterType" class="form-select" @change="applyFilters">
                                <option value="all">All Notifications</option>
                                <option value="announcement">Announcements</option>
                                <option value="system">System</option>
                                <option value="reminder">Reminders</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-envelope me-2"></i>Filter by Status</label>
                            <select v-model="filterStatus" class="form-select" @change="applyFilters">
                                <option value="all">All</option>
                                <option value="unread">Unread Only</option>
                                <option value="read">Read Only</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-search me-2"></i>Search</label>
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

                <!-- Notifications List (Vue.js) -->
                <div v-if="!loading" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fas fa-bell text-warning me-2"></i>
                                    All Notifications ({{ filteredNotifications.length }})
                                </div>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-secondary" :class="{ active: sortBy === 'newest' }" @click="sortBy = 'newest'; sortNotifications()">
                                        Newest First
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" :class="{ active: sortBy === 'oldest' }" @click="sortBy = 'oldest'; sortNotifications()">
                                        Oldest First
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Empty State -->
                                <div v-if="filteredNotifications.length === 0" class="text-center py-5">
                                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                    <h5>No Notifications</h5>
                                    <p class="text-muted">You don't have any notifications matching your filters.</p>
                                </div>

                                <!-- Notification Items -->
                                <transition-group name="fade">
                                    <div 
                                        v-for="notification in filteredNotifications" 
                                        :key="notification.id"
                                        class="notification-item d-flex"
                                        :class="{ 'unread': !notification.read }"
                                        @click="markAsRead(notification.id)">
                                        <div :class="['notification-icon', getNotificationClass(notification.type)]">
                                            <i :class="getNotificationIcon(notification.type)"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <h6 class="mb-1">
                                                    {{ notification.title }}
                                                    <span v-if="!notification.read" class="badge bg-danger ms-2" style="font-size: 0.65rem;">NEW</span>
                                                </h6>
                                                <div class="d-flex align-items-center">
                                                    <small class="text-muted me-3">{{ formatDate(notification.date) }}</small>
                                                    <button class="btn btn-sm btn-link text-danger p-0" @click.stop="deleteNotification(notification.id)" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <p class="mb-1">{{ notification.message }}</p>
                                        </div>
                                    </div>
                                </transition-group>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vue.js 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    
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
                    sortBy: 'newest',
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
                this.initializeFromBackend();
                this.applyFilters();
            },
            methods: {
                // BACKEND CONNECTION: Get notifications from Laravel controller
                initializeFromBackend() {
                    // Replace with actual backend data:
                    // this.notifications = @json($notifications);
                    
                    // Sample data for demonstration
                    this.notifications = [
                        {
                            id: 1,
                            type: 'announcement',
                            title: 'New Dental Services Available',
                            message: "We're excited to announce that dental check-ups and treatments are now available at the clinic. Book your appointment today!",
                            date: new Date().toISOString(),
                            read: false
                        },
                        {
                            id: 2,
                            type: 'system',
                            title: 'System Maintenance',
                            message: 'The appointment system will be temporarily unavailable on March 25 from 2:00 AM to 4:00 AM for scheduled maintenance.',
                            date: new Date(Date.now() - 86400000).toISOString(),
                            read: false
                        },
                        {
                            id: 3,
                            type: 'reminder',
                            title: 'Appointment Reminder',
                            message: 'Your appointment with Dr. Maria Santos is scheduled for tomorrow at 10:30 AM. Please arrive 15 minutes early.',
                            date: new Date(Date.now() - 172800000).toISOString(),
                            read: true
                        },
                        {
                            id: 4,
                            type: 'announcement',
                            title: 'Clinic Holiday Announcement',
                            message: 'The clinic will be closed on March 20 for a local holiday. Regular operations will resume on March 21.',
                            date: new Date(Date.now() - 432000000).toISOString(),
                            read: true
                        },
                        {
                            id: 5,
                            type: 'system',
                            title: 'New Features Added',
                            message: "We've added new features to the appointment system, including appointment history and prescription tracking.",
                            date: new Date(Date.now() - 864000000).toISOString(),
                            read: true
                        },
                        {
                            id: 6,
                            type: 'announcement',
                            title: 'New Doctor Joining',
                            message: 'Dr. Robert Lim, our new dental specialist, is now accepting appointments. Welcome Dr. Lim to our team!',
                            date: new Date(Date.now() - 1296000000).toISOString(),
                            read: true
                        },
                        {
                            id: 7,
                            type: 'reminder',
                            title: 'Appointment Completed',
                            message: 'Your dental check-up with Dr. Robert Lim has been completed. You can view your dental records in your profile.',
                            date: new Date(Date.now() - 1728000000).toISOString(),
                            read: true
                        },
                        {
                            id: 8,
                            type: 'system',
                            title: 'Password Reset Required',
                            message: 'For security purposes, please reset your password. This is a routine security measure.',
                            date: new Date(Date.now() - 2160000000).toISOString(),
                            read: true
                        }
                    ];
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

                    this.filteredNotifications = filtered;
                    this.sortNotifications();
                },

                sortNotifications() {
                    this.filteredNotifications.sort((a, b) => {
                        const dateA = new Date(a.date);
                        const dateB = new Date(b.date);
                        return this.sortBy === 'newest' ? dateB - dateA : dateA - dateB;
                    });
                },

                // BACKEND CONNECTION: Mark notification as read
                markAsRead(notificationId) {
                    const notification = this.notifications.find(n => n.id === notificationId);
                    if (notification && !notification.read) {
                        notification.read = true;
                        
                        // Example API call:
                        // fetch(`/api/notifications/${notificationId}/read`, { method: 'POST' });
                        
                        console.log(`Marked notification ${notificationId} as read`);
                    }
                },

                // BACKEND CONNECTION: Mark all as read
                markAllAsRead() {
                    this.notifications.forEach(n => n.read = true);
                    
                    // Example API call:
                    // fetch('/api/notifications/mark-all-read', { method: 'POST' });
                    
                    console.log('All notifications marked as read');
                },

                // BACKEND CONNECTION: Delete notification
                deleteNotification(notificationId) {
                    if (confirm('Are you sure you want to delete this notification?')) {
                        const index = this.notifications.findIndex(n => n.id === notificationId);
                        if (index !== -1) {
                            this.notifications.splice(index, 1);
                            this.applyFilters();
                            
                            // Example API call:
                            // fetch(`/api/notifications/${notificationId}`, { method: 'DELETE' });
                            
                            console.log(`Deleted notification ${notificationId}`);
                        }
                    }
                },

                // BACKEND CONNECTION: Delete all notifications
                deleteAll() {
                    if (confirm('Are you sure you want to delete all notifications? This cannot be undone.')) {
                        this.notifications = [];
                        this.filteredNotifications = [];
                        
                        // Example API call:
                        // fetch('/api/notifications/delete-all', { method: 'DELETE' });
                        
                        console.log('All notifications deleted');
                    }
                },

                getNotificationIcon(type) {
                    const icons = {
                        'announcement': 'fas fa-bullhorn',
                        'system': 'fas fa-bell',
                        'reminder': 'fas fa-calendar-day'
                    };
                    return icons[type] || 'fas fa-bell';
                },

                getNotificationClass(type) {
                    const classes = {
                        'announcement': 'notification-announcement',
                        'system': 'notification-system',
                        'reminder': 'notification-reminder'
                    };
                    return classes[type] || 'notification-system';
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
                        return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                    }
                }
            }
        }).mount('#notificationsApp');
    </script>

    <!-- 
    ==========================================
    BACKEND INTEGRATION INSTRUCTIONS:
    ==========================================
    
    In your Laravel Controller (e.g., NotificationController.php):
    
    public function index() {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'date' => $notification->created_at->toISOString(),
                    'read' => $notification->read
                ];
            });
        
        $user = auth()->user();
        return view('patient.notifications', compact('notifications', 'user'));
    }
    
    API Routes for actions:
    
    // Mark as read
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    
    // Mark all as read
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    
    // Delete notification
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete']);
    
    // Delete all
    Route::delete('/notifications/delete-all', [NotificationController::class, 'deleteAll']);
    
    Then in the Vue code, uncomment:
    this.notifications = @json($notifications);
    
    ==========================================
    -->
</body>
</html>