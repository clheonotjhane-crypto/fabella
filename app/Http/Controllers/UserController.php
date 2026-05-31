<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display Users Table
    public function usersTable()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    // Add User
    public function addUser(Request $request)
    {
        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Account already exists');
        }

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make('password123')
        ]);

        return back()->with('success', 'User added successfully');
    }

    // Update User
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        
        if(!$user){
            return back()->with('error', 'User not found');
        }

        // Check if email changed and already exists
        if($request->email != $user->email && User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email already exists');
        }

        $user->update([
            'name' => $request->fullname,
            'email' => $request->email
        ]);

        return back()->with('success', 'User updated successfully');
    }

    // Delete User
    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if(!$user){
            return back()->with('error', 'User not found');
        }

        // Prevent deleting yourself
        if($user->id == session('user_id')){
            return back()->with('error', 'Cannot delete your own account');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}