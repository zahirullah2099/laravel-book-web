<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile()
    {
        return view('userProfile.profile');
    }


    // code for profile update
    public function updateProfile(Request $request)
    {
        $user = Auth::user();  // Get the authenticated user
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,  // Avoid email uniqueness for the current user
            'password' => 'nullable|confirmed'
        ]);
    
        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        // Save the updated user
         if( $user->save()){
            // Redirect back with success message
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
         }  
    
        
    }
    
}
