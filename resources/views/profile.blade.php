<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Clinic Appointment System - Profile</title>
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
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light-green);
        }
        .appointment-badge {
            background-color: var(--light-green);
            color: var(--dark-green);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
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
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications') }}">
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

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">My Profile</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-user text-info me-2"></i>
                                Personal Information
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('img/profile_justin.jpg') }}" alt="Profile" class="profile-img mb-3">
                                    <h4>{{ $user->first_name }} {{ $user->last_name}}</h4>
                                    <p class="text-muted">Student ID: {{ $user->id_number }}</p>
                                    <p>
                                        <span class="appointment-badge me-2">2 Upcomings</span>
                                        <span class="appointment-badge">5 Completed</span>
                                    </p>
                                </div>
                                <form>
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" value="{{ $user->first_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" value="{{ $user->last_name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="studentId" class="form-label">Student ID</label>
                                            <input type="text" class="form-control" id="studentId" value="{{ $user->id_number }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="department" class="form-label">Institute</label>
                                            <input type="text" class="form-control" id="department" value="{{ $user->institute }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="studentId" class="form-label">Height</label>
                                            <input type="text" class="form-control" id="height" value="{{ $user->height }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="department" class="form-label">Weight</label>
                                            <input type="text" class="form-control" id="weight" value="{{ $user->weight }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" value="{{ $user->email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" value="{{ $user->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="3">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="birthdate" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="birthdate" value="2006-05-18">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender</label> <!-- parama fetch dapat ma connect sa sa vue-->
                                            <select class="form-select" id="gender" v-model="gender">
                                                <option :selected="$user->gender === 'male'">Male</option>
                                                <option :selected="$user->gender === 'female'">Female</option>
                                                <option :selected="$user->gender === 'other'">other</option>
                                                <option :selected="$user->gender === 'Prefer not to say'">Prefer not to say</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emergencyContact" class="form-label">Emergency Contact</label>
                                        <input type="text" class="form-control" id="emergencyContact" value="{{ $user->emergency_cont }}">
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <a href="dashboard.html" class="btn btn-outline-secondary me-md-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary-custom">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- New Change Password Card -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-lock text-warning me-2"></i>
                                Change Password
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="currentPassword" placeholder="Enter your current password">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                        <button type="submit" class="btn btn-primary-custom">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>