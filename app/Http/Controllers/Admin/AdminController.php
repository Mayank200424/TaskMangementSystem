<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($check)) {
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page.');
            }
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->route('admin.login')->with('error', 'Either Email or Password Is Incorrect');
        }
    }

    public function dashboard(){
        $users = User::all();

        return view('admin.dashboard',compact('users'));
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}
