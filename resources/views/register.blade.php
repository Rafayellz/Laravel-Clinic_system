<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #28a745;
            --light-green: #d4edda;
            --dark-green: #1e7e34;
            --light-gray: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montseratt', sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .register-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-height: 95vh;
        }
        
        .image-section {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #333;
            text-align: center;
            border-right: 1px solid #eee;
        }
        
        .logo-container {
            width: 200px;
            height: 200px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-container img {
            max-width: 130%;
            max-height: 130%;
            object-fit: contain;
        }
        
        .image-section h2 {
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--dark-green);
        }
        
        .image-section p {
            color: #666;
            line-height: 1.5;
        }
        
        .form-section {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            max-height: 95vh;
        }
        
        .school-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
            font-weight: bold;
            font-size: 24px;
            margin: 0 auto 20px;
            overflow: hidden;
        }
        
        .school-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 5px;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-title h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .form-title p {
            color: #666;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        
        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.2);
        }
        
        .register-btn {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 10px;
        }
        
        .register-btn:hover {
            background-color: var(--dark-green);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .row {
            margin-left: -8px;
            margin-right: -8px;
        }
        
        .col-md-6 {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        /* Password validation styles */
        .password-feedback {
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .valid-feedback {
            color: var(--primary-green);
            display: none;
        }
        
        .invalid-feedback {
            color: #dc3545;
            display: none;
        }
        
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                max-height: none;
            }
            
            .image-section {
                display: none;
            }
            
            .form-section {
                padding: 25px 15px;
                max-height: none;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="image-section">
            <div class="logo-container">
                <img src="{{ asset('img/CLINIC_LOGO.png') }}" alt="Logo">
            </div>
            <h2><b>DNSC CLINIC APPOINTMENT SYSTEM</b></h2>
            <p>Secure and convenient appointment scheduling</p>
        </div>
        
        <div class="form-section"> 
            <div class="form-title">
                <div class="school-logo">
                    <img src="{{ asset('img/DNSC_LOGO.png') }}" alt="DNSC LOGO">
                </div>
                <h2>Create Your Account</h2>
                <p>Fill in your details to register for the system</p>
            </div>
            
            <form id="registerForm" action="{{ route('registervalidate') }}" method="POST"> 
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="full_name"  placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idNumber">ID Number</label>
                            <input type="text" id="idNumber" name="id_number" placeholder="Enter your ID number" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="department">Institute</label>
                            <select id="department" name="institute" required>
                                <option value="" selected disabled>Select your Institute</option>
                                <option value="IC">IC</option>
                                <option value="ITED">ITED</option>
                                <option value="ILEGG">ILEGG</option>
                                <option value="IAAS">IAAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender"  name="gender" required>
                                <option value="" selected disabled>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Height (cm)</label>
                            <input type="number" id="height" name="height" placeholder="Enter your height" min="100" max="250" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" id="weight" name="weight" placeholder="Enter your weight" min="30" max="200" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="" selected disabled>Select your role</option>
                        <option value="Patient">Patient</option>
                        <option value="Clinic Staff">Clinic Staff</option>
                        <option value="Doctor">Doctor</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Choose a username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password"  name="password" placeholder="Password must be at least 8 characters" required>
                    <div class="password-feedback">
                        <div class="valid-feedback" id="length-valid">✓ At least 8 characters</div>
                        <div class="invalid-feedback" id="length-invalid">✗ At least 8 characters</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                    <div class="password-feedback">
                        <div class="valid-feedback" id="match-valid">✓ Passwords match</div>
                        <div class="invalid-feedback" id="match-invalid">✗ Passwords do not match</div>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                 @endif
                
                <button type="submit" class="register-btn">Register</button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>


</body>
</html>