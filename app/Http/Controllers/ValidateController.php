<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
   public function registervalidate(Request $request){
        // Only allow POST requests
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
                'id_number' => 'required|string',
                'phone_number' => 'required|numeric|min:11',
                'institute' => 'required|string|in:IC,ITED,ILEGG,IAAS',
                'gender' => 'required|string|in:male,female,other,prefer_not_to_say',
                'height' => 'required|numeric|min:100',
                'weight' => 'required|numeric|min:30',
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
                    'redirect' => route('test_login')
                ]);
            }

            return redirect('test_login')->with('success', 'Registration successful!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }
    }
    
    public function create(array $data){
        return User::create([
            'first_name'   => $data['first_name'],
            'last_name'   => $data['last_name'],
            'id_number'   => $data['id_number'],
            'phone_number'   => $data['phone_number'],
            'institute'   => $data['institute'],
            'gender'      => $data['gender'],
            'height'      => $data['height'],
            'weight'      => $data['weight'],
            'address'      => $data['address'],
            'emergency_cont' => $data['emergency_cont'],
            'email'      => $data['email'],
            'username'    => $data['email'],
            'password'    => Hash::make($data['password']),
            'role'        => 'Patient',
        ]);
    }

    public function loginvalidate(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt(['email'=>$credentials['email'], 'password' => $credentials['password']])){
        $role= Auth::user()->role;
        if($role == 'Doctor'){
            return redirect('admin_dashboard')->withSuccess('Login Success');
        } elseif($role == 'Clinic Staff'){
            return redirect('staff_dashboard')->withSuccess('Login Success');
        } else {
            return redirect('dashboard')->withSuccess('Login Success');
        }
    }
        return back()->withErrors([
            'all'=>'The provided credentials do not match our records.',
        ]);
    }

    

}
