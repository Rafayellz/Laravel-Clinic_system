<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Patient;

class ValidateController extends Controller
{
   public function registervalidate(Request $request){
        if (!$request->isMethod('post')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request method'
            ], 405);
        }

        try {
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'id_number' => 'required|string|unique:patient,id_number',
                'phone_number' => 'required|numeric|min:11',
                'institute' => 'required|string|in:IC,ITED,ILEGG,IAAS',
                'gender' => 'required|string|in:male,female,other,prefer_not_to_say',
                'height' => 'required|numeric|min:100',
                'weight' => 'required|numeric|min:30',
                'date_of_birth' => 'required|date',
                'address' => 'required|string',
                'emergency_cont' => 'required|string|min:11',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = $this->create($validated);
            Auth::login($user);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful!',
                    'redirect' => route('login')
                ]);
            }

            return redirect('login')->with('success', 'Registration successful!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
    
    public function create(array $data){
        try {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'patient'
            ]);

            Patient::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'id_number' => $data['id_number'], 
                'phone_number' => $data['phone_number'],
                'institute' => $data['institute'],
                'gender' => $data['gender'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'date_of_birth' => $data['date_of_birth'], 
                'address' => $data['address'],
                'emergency_cont' => $data['emergency_cont'], 
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            
            return $user;
        } catch (\Exception $e) {
            $errorMsg = "ERROR: " . $e->getMessage() . " | File: " . $e->getFile() . " | Line: " . $e->getLine();
            file_put_contents(storage_path('logs/error.txt'), $errorMsg . "\n", FILE_APPEND);
            throw $e;
        }
    }

    public function loginvalidate(Request $request){
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $role = Auth::user()->role;
                
                if ($role === 'doctor') { 
                    return redirect()->route('doctor_dashboard');
                } elseif ($role === 'staff') { 
                    return redirect()->route('staff_dashboard');
                } elseif ($role === 'admin') {  
                    return redirect()->route('admin_dashboard');
                } else {  
                    return redirect()->route('dashboard');
                }
            }

            return back()->withErrors([
                'all'=>'The provided credentials do not match our records.',
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}