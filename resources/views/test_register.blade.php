<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <style>
        /* Your existing CSS remains the same */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 520px;
            position: relative;
        }
        
        .image-section {
            flex: 1;
            background: linear-gradient(135deg, #1a5c38 0%, #2a7a52 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .logo-container {
            margin-bottom: 25px;
        }
        
        .logo-container img {
            max-width: 100px;
            height: auto;
            filter: brightness(0) invert(1);
        }
        
        .image-section h2 {
            font-size: 1.4rem;
            font-weight: 600;
            line-height: 1.4;
            margin-top: 15px;
        }
        
        .form-section {
            flex: 1;
            padding: 40px 35px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            max-height: 520px;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .school-logo {
            margin-bottom: 15px;
        }
        
        .school-logo img {
            max-width: 70px;
            height: auto;
        }
        
        .form-title h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #1a5c38;
            margin-bottom: 8px;
        }
        
        .form-title p {
            color: #666;
            font-size: 0.9rem;
        }
        
        #registerForm {
            width: 100%;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
            font-size: 0.9rem;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26, 92, 56, 0.1);
        }
        
        .form-group input::placeholder {
            color: #999;
        }
        
        .alert {
            padding: 14px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }
        
        .alert ul {
            margin-bottom: 0;
            padding-left: 18px;
        }
        
        .text-danger {
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
            min-height: 18px;
        }
        
        .register-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1a5c38 0%, #2a7a52 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .register-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(26, 92, 56, 0.3);
        }
        
        .register-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            opacity: 0.6;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
        }
        
        .login-link p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        .login-link a {
            color: #1a5c38;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
            color: #2a7a52;
            text-decoration: underline;
        }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8px;
            margin-right: -8px;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-left: 8px;
            padding-right: 8px;
        }
        
        .password-feedback {
            font-size: 0.75rem;
            margin-top: 5px;
        }
        
        .valid-feedback {
            color: #1a5c38;
        }
        
        .invalid-feedback {
            color: #dc3545;
        }
        
        .has-error input,
        .has-error select {
            border-color: #dc3545;
        }
        
        .has-success input,
        .has-success select {
            border-color: #1a5c38;
        }
        
        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin-top: 10px;
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                max-width: 420px;
                min-height: auto;
            }
            
            .image-section {
                padding: 25px 20px;
            }
            
            .image-section h2 {
                font-size: 1.2rem;
            }
            
            .form-section {
                padding: 35px 25px;
                max-height: none;
            }
            
            .form-title h2 {
                font-size: 1.4rem;
            }
            
            body {
                padding: 15px;
            }
            
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .form-section {
                padding: 25px 20px;
            }
            
            .image-section {
                padding: 20px 15px;
            }
            
            .logo-container img {
                max-width: 80px;
            }
            
            .school-logo img {
                max-width: 60px;
            }
            
            .form-title h2 {
                font-size: 1.3rem;
            }
            
            .form-group input,
            .form-group select {
                padding: 10px 12px;
            }
            
            .register-btn {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div id="app" class="register-container">
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
                <h2>Create Your Account</h2>
                <p>Fill in your details to register for the system</p>
            </div>
            
            <form id="registerForm" @submit.prevent="submitForm" action="{{ route('registervalidate') }}" method="POST">
                @csrf
                
                <!-- Server-side errors from Laravel -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Vue.js errors -->
                <div class="alert alert-danger" v-if="Object.keys(errors).length > 0">
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        <li v-for="error in allErrors">@{{ error }}</li>
                    </ul>
                </div>
                
                <!-- Success message -->
                <div class="alert alert-success" v-if="successMessage">
                    @{{ successMessage }}
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.first_name}">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="first_name" v-model="form.first_name" 
                                   placeholder="Enter your first name" required>
                            <span class="text-danger" v-if="errors.first_name">@{{ errors.first_name[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.last_name}">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="last_name" v-model="form.last_name" 
                                   placeholder="Enter your last name" required>
                            <span class="text-danger" v-if="errors.last_name">@{{ errors.last_name[0] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.id_number}">
                            <label for="idNumber">Student ID</label>
                            <input type="text" id="idNumber" name="id_number" v-model="form.id_number" 
                                   placeholder="Enter your ID number" required>
                            <span class="text-danger" v-if="errors.id_number">@{{ errors.id_number[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.phone_number}">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="phone_number" v-model="form.phone_number" 
                                   placeholder="Enter your phone number" required>
                            <span class="text-danger" v-if="errors.phone_number">@{{ errors.phone_number[0] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.institute}">
                            <label for="department">Institute</label>
                            <select id="department" name="institute" v-model="form.institute" required>
                                <option value="" selected disabled>Select your Institute</option>
                                <option value="IC">IC</option>
                                <option value="ITED">ITED</option>
                                <option value="ILEGG">ILEGG</option>
                                <option value="IAAS">IAAS</option>
                            </select>
                            <span class="text-danger" v-if="errors.institute">@{{ errors.institute[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.gender}">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" v-model="form.gender" required>
                                <option value="" selected disabled>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            <span class="text-danger" v-if="errors.gender">@{{ errors.gender[0] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.height}">
                            <label for="height">Height (cm)</label>
                            <input type="number" id="height" name="height" v-model="form.height" 
                                   placeholder="Enter your height" min="100" max="250" required>
                            <span class="text-danger" v-if="errors.height">@{{ errors.height[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" :class="{'has-error': errors.weight}">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" id="weight" name="weight" v-model="form.weight" 
                                   placeholder="Enter your weight" min="30" max="200" required>
                            <span class="text-danger" v-if="errors.weight">@{{ errors.weight[0] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.address}">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" v-model="form.address" 
                           placeholder="Enter your complete address" required>
                    <span class="text-danger" v-if="errors.address">@{{ errors.address[0] }}</span>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.emergency_cont}">
                    <label for="emergencyContact">Emergency Contact</label>
                    <input type="text" id="emergencyContact" name="emergency_cont" v-model="form.emergency_cont" 
                           placeholder="Enter emergency contact number" required>
                    <span class="text-danger" v-if="errors.emergency_cont">@{{ errors.emergency_cont[0] }}</span>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.email}">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" v-model="form.email" 
                           placeholder="Enter your email address" required>
                    <span class="text-danger" v-if="errors.email">@{{ errors.email[0] }}</span>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.password}">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" v-model="form.password" 
                           placeholder="Password must be at least 8 characters" required>
                    <div class="password-feedback">
                        <div class="valid-feedback" v-show="passwordLengthValid">✓ At least 8 characters</div>
                        <div class="invalid-feedback" v-show="!passwordLengthValid && form.password">✗ At least 8 characters</div>
                    </div>
                    <span class="text-danger" v-if="errors.password">@{{ errors.password[0] }}</span>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.password_confirmation}">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="password_confirmation" v-model="form.password_confirmation" 
                           placeholder="Confirm your password" required>
                    <div class="password-feedback">
                        <div class="valid-feedback" v-show="passwordsMatch">✓ Passwords match</div>
                        <div class="invalid-feedback" v-show="!passwordsMatch && form.password_confirmation">✗ Passwords do not match</div>
                    </div>
                    <span class="text-danger" v-if="errors.password_confirmation">@{{ errors.password_confirmation[0] }}</span>
                </div>
                
                <button type="submit" class="register-btn" :disabled="loading">
                    <span v-if="loading">Processing...</span>
                    <span v-else>Register</span>
                </button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="{{ route('test_login') }}">Login here</a></p>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                form: {
                    first_name: '',
                    last_name: '',
                    id_number: '',
                    phone_number: '',
                    institute: '',
                    gender: '',
                    height: '',
                    weight: '',
                    address: '',
                    emergency_cont: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {},
                loading: false,
                successMessage: '',
                debugMode: false, // Set to false in production
                lastError: '',
                responseStatus: ''
            },
            computed: {
                passwordLengthValid() {
                    return this.form.password.length >= 8;
                },
                passwordsMatch() {
                    return this.form.password === this.form.password_confirmation && this.form.password !== '';
                },
                allErrors() {
                    let allErrors = [];
                    for (let field in this.errors) {
                        if (this.errors.hasOwnProperty(field)) {
                            // Handle both array and string error formats
                            if (Array.isArray(this.errors[field])) {
                                allErrors = allErrors.concat(this.errors[field]);
                            } else {
                                allErrors.push(this.errors[field]);
                            }
                        }
                    }
                    return allErrors;
                }
            },
            methods: {
                submitForm() {
                    // Basic client-side validation
                    if (!this.passwordLengthValid) {
                        this.errors = { password: ['Password must be at least 8 characters long'] };
                        return;
                    }
                    
                    if (!this.passwordsMatch) {
                        this.errors = { password_confirmation: ['Passwords do not match'] };
                        return;
                    }

                    this.loading = true;
                    this.errors = {};
                    this.successMessage = '';
                    this.lastError = '';
                    this.responseStatus = '';

                    // Create FormData for submission
                    const formData = new FormData();
                    for (let key in this.form) {
                        if (this.form[key] !== null && this.form[key] !== undefined) {
                            formData.append(key, this.form[key]);
                        }
                    }

                    // Add CSRF token
                    const csrfToken = document.querySelector('input[name="_token"]').value;
                    
                    fetch("{{ route('registervalidate') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        this.responseStatus = `Status: ${response.status}`;
                        
                        // Handle 422 Unprocessable Entity specifically
                        if (response.status === 422) {
                            return response.json().then(data => {
                                // Filter out errors for fields that no longer exist
                                if (data.errors) {
                                    const filteredErrors = {};
                                    for (let field in data.errors) {
                                        // Skip fields that don't exist in our form
                                        if (this.form.hasOwnProperty(field) || field === 'password' || field === 'password_confirmation') {
                                            filteredErrors[field] = data.errors[field];
                                        }
                                    }
                                    this.errors = filteredErrors;
                                    
                                    // If we filtered out all errors but still got a 422, show generic message
                                    if (Object.keys(filteredErrors).length === 0) {
                                        this.errors = { general: ['Please check all fields are filled correctly.'] };
                                    }
                                } else if (data.message) {
                                    this.errors = { general: [data.message] };
                                } else {
                                    this.errors = { general: ['Validation failed. Please check your input.'] };
                                }
                                this.loading = false;
                                return null;
                            });
                        }
                        
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return; // Already handled 422 case
                        
                        this.loading = false;
                        
                        if (data.errors) {
                            // Filter out errors for fields that no longer exist
                            const filteredErrors = {};
                            for (let field in data.errors) {
                                if (this.form.hasOwnProperty(field) || field === 'password' || field === 'password_confirmation') {
                                    filteredErrors[field] = data.errors[field];
                                }
                            }
                            this.errors = filteredErrors;
                        } else if (data.success) {
                            this.successMessage = data.message || 'Registration successful! Redirecting...';
                            
                            // Clear form
                            Object.keys(this.form).forEach(key => {
                                this.form[key] = '';
                            });
                            
                            // Redirect after success
                            setTimeout(() => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                } else {
                                    window.location.href = "{{ route('test_login') }}";
                                }
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error details:', error);
                        this.loading = false;
                        this.lastError = error.message;
                        
                        if (error.message.includes('422')) {
                            this.errors = { general: ['Validation error. Please check all fields are filled correctly.'] };
                        } else {
                            this.errors = { general: [error.message || 'An error occurred. Please try again.'] };
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>