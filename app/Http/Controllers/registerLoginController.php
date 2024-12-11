<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class registerLoginController extends Controller
{
    public function showLogin(){ 
        if (Auth::check()) {
            return redirect()->back(); // Redirect to the previous page if authenticated
        }
        return view('auth.login');
    }


    public function showRegister(){ 
        if (Auth::check()) {
            return redirect()->back(); // Redirect to the previous page if authenticated
        }
        return view('auth.register');
    }
    
    
    public function registerUser(Request $request){
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required'
         ]);

         $user = new User();
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->role = $request->input('role');
         $user->password = bcrypt($request->input('password'));
         if($user->save()){
            flash()->success('User Registered Successfully');
            return redirect()->route('show.login');
         }
    }

    // code for login
    public function loginUser(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
 
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }
        flash()->error('Invalid email or password.');
        return redirect()->back();
    }

    // code for logout
    public function logoutUser(){
        Auth::logout();
        flash()->success('User Logout Successfully!');
        return redirect()->route('show.login');
    }
}
