<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="image-section">
            <div class="logo-container">
                <img src="{{ asset('img/CLINIC_LOGO.png') }}" alt="Logo">
            </div>
            <h2><b>DNSC CLINIC APPOINTMENT SYSTEM</b></h2>
        </div>
        
        <div class="form-section">
            <div class="form-title">
                <div class="school-logo">
                    <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC LOGO">
                </div>
                <h2>Login to Your Account</h2>
                <p>Enter your credentials to access the system</p>
            </div>
            
            <form id="loginForm" action="{{ route('loginvalidate') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    @if ($errors->has('username'))
                    <span class="text-danger">{{ errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ errors->first('password') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role"required>
                        <option value="" selected disabled>Select your role</option>
                        <option value="Patient">Patient</option>
                        <option value="Clinic Staff">Clinic Staff</option>
                        <option value="Doctor">Doctor</option>
                    </select>
                    @if ($errors->has('role'))
                    <span class="text-danger">{{ errors->first('role') }}</span>
                    @endif
                    <!-- Error Credentials -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>  
                <button type="submit" class="login-btn">Login</button>
            </form>
            
            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </div>
    </div>

</body>
</html>