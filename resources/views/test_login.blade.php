<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <style>
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
            padding: 15px;
        }
        .login-container {
            display: flex;
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 450px;
        }
        .image-section {
            flex: 1;
            background: linear-gradient(135deg, #1a5c38 0%, #2a7a52 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px;
            text-align: center;
            color: white;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-container img {
            max-width: 80px;
            height: auto;
            filter: brightness(0) invert(1);
        }
        .image-section h2 {
            font-size: 1.2rem;
            font-weight: 600;
            line-height: 1.3;
            margin-top: 12px;
        }
        .form-section {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .school-logo {
            margin-bottom: 12px;
        }
        .school-logo img {
            max-width: 60px;
            height: auto;
        }
        .form-title h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #1a5c38;
            margin-bottom: 6px;
        }
        .form-title p {
            color: #666;
            font-size: 0.85rem;
        }
        #loginForm {
            width: 100%;
        }
        .form-group {
            margin-bottom: 16px;
            position: relative;
            /* Reserve space for error messages */
            padding-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
            font-size: 0.85rem;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 0.9rem;
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
        .error-container {
            min-height: 50px;
            margin-bottom: 12px;
        }
        .alert {
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 0;
            font-size: 0.8rem;
        }
        .alert ul {
            margin-bottom: 0;
            padding-left: 16px;
        }
        .text-danger {
            font-size: 0.75rem;
            margin-top: 4px;
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1a5c38 0%, #2a7a52 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(26, 92, 56, 0.3);
        }
        .login-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e1e5e9;
        }
        .register-link p {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0;
        }
        .register-link a {
            color: #1a5c38;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .register-link a:hover {
            color: #2a7a52;
            text-decoration: underline;
        }

        /* Vue.js specific styles */
        .field-error {
            border-color: #dc3545 !important;
        }
        .error-message {
            opacity: 0;
            height: 0;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .error-message.show {
            opacity: 1;
            height: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
                min-height: auto;
            }
            .image-section {
                padding: 20px;
            }
            .image-section h2 {
                font-size: 1.1rem;
            }
            .form-section {
                padding: 25px;
            }
            .form-title h2 {
                font-size: 1.3rem;
            }
            body {
                padding: 10px;
            }
        }
        @media (max-width: 480px) {
            .form-section {
                padding: 20px;
            }
            .image-section {
                padding: 15px;
            }
            .logo-container img {
                max-width: 70px;
            }
            .school-logo img {
                max-width: 50px;
            }
            .form-title h2 {
                font-size: 1.2rem;
            }
            .form-group input,
            .form-group select {
                padding: 9px 10px;
            }
            .login-btn {
                padding: 11px;
            }
            .error-container {
                min-height: 45px;
            }
        }
    </style>
</head>
<body>
    <div id="app" class="login-container">
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

            <form id="loginForm" @submit.prevent="submitForm"  action="{{ route('loginvalidate') }}" method="POST">
                @csrf
                <div class="error-container">
                    <div v-if="serverErrors.length > 0" class="alert alert-danger">
                        <ul class="mb-0">
                            <li v-for="error in serverErrors" :key="error">@{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        v-model="formData.email"
                        :class="{'field-error': errors.email}"
                        @blur="validateField('email')"
                        placeholder="Enter your email" 
                        required>
                    <span class="text-danger error-message" :class="{'show': errors.email}">
                        @{{ errors.email }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        v-model="formData.password"
                        :class="{'field-error': errors.password}"
                        @blur="validateField('password')"
                        placeholder="Enter your password" 
                        required>
                    <span class="text-danger error-message" :class="{'show': errors.password}">
                        @{{ errors.password }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="role">Select User</label>
                    <select 
                        id="role" 
                        name="role" 
                        v-model="formData.role"
                        :class="{'field-error': errors.role}"
                        @blur="validateField('role')"
                        required>
                        <option value="" selected disabled>Choose your user type</option>
                        <option value="Patient">Patient</option>
                        <option value="clinicstaff">Clinic Staff</option>
                        <option value="Doctor">Doctor</option>
                    </select>
                    <span class="text-danger error-message" :class="{'show': errors.role}">
                        @{{ errors.role }}
                    </span>
                </div>

                <button 
                    type="submit" 
                    class="login-btn" 
                    :disabled="isSubmitting">
                    @{{ isSubmitting ? 'Logging in...' : 'Login' }}
                </button>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('test_register') }}">Register here</a></p>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                formData: {
                    email: '',
                    password: '',
                    role: ''
                },
                errors: {
                    email: '',
                    password: '',
                    role: ''
                },
                serverErrors: [],
                isSubmitting: false
            },
            methods: {
                validateField(field) {
                    // Clear previous error
                    this.errors[field] = '';
                    
                    // Validate based on field
                    switch(field) {
                        case 'emil':
                            if (!this.formData.username.trim()) {
                                this.errors.username = 'email is required';
                            } else if (this.formData.username.length < 3) {
                                this.errors.username = 'email must have a @';
                            }
                            break;
                        case 'password':
                            if (!this.formData.password) {
                                this.errors.password = 'Password is required';
                            } else if (this.formData.password.length < 6) {
                                this.errors.password = 'Password must be at least 6 characters';
                            }
                            break;
                        case 'role':
                            if (!this.formData.role) {
                                this.errors.role = 'Please select your role';
                            }
                            break;
                    }
                },
                validateForm() {
                    // Validate all fields
                    this.validateField('email');
                    this.validateField('password');
                    this.validateField('role');
                    
                    // Check if form is valid
                    return !this.errors.username && !this.errors.password && !this.errors.role;
                },
                submitForm() {
                    // Clear previous errors
                    this.serverErrors = [];
                    
                    // Validate form
                    if (!this.validateForm()) {
                        return;
                    }
                    
                    // Set submitting state
                    this.isSubmitting = true;
                    
                    // Submit form via AJAX
                    fetch("{{ route('loginvalidate') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => {
                        if (response.redirected) {
                            // If redirecting, follow the redirect
                            window.location.href = response.url;
                        } else {
                            return response.json();
                        }
                    })
                    .then(data => {
                        if (data && data.errors) {
                            // Handle validation errors from server
                            this.serverErrors = Object.values(data.errors).flat();
                        } else if (data && data.message) {
                            // Handle other server messages
                            this.serverErrors = [data.message];
                        }
                        this.isSubmitting = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.serverErrors = ['An error occurred during login. Please try again.'];
                        this.isSubmitting = false;
                    });
                }
            }
        });
    </script>
</body>
</html>