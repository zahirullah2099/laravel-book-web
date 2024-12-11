<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class registerLoginController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }


    public function showRegister(){ 
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
    }

    // code for logout
    public function logoutUser(){
        Auth::logout();
        return redirect()->route('show.login');
    }
}
