<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        // Check if email already exists
        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email already exists');
        }

        // Check if password and confirm password matches
        if($request->password !== $request->confirmpassword){
            return back()->with('error', 'Passwords do not match');
        }

        // Create user
        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Account successfully created');
    }

    // Show Login Page
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('error', 'Invalid credentials');
        }

        session(['user_id' => $user->id]);

        return redirect('/dashboard')->with('success', 'Login successful');
    }

    // Show Dashboard
    public function showDashboard()
    {
        return view('dashboard');
    }

    // Show Profile
    public function showProfile()
    {
        return view('profile');
    }

    // Update Profile Info
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . session('user_id'),
        ]);

        $user = User::find(session('user_id'));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    // Update Profile Picture
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $userId = session('user_id');
        $user = User::find($userId);

        // Upload new picture
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            // Update user
            $user->profile_picture = $filename;
            $user->save();
        }

        return back()->with('success', 'Picture uploaded successfully');
    }
}