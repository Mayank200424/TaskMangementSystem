<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Authentication extends Controller
{
    public function registerform()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = $request->role;

        if ($users->save()) {
            Mail::to($users->email)->send(new WelcomeMessage($users));
            if ($users->role === 'admin') {
                return redirect()->route('admin.login')->with('success', 'Register SuccessFully');
            } elseif ($users->role === 'employee') {
                return redirect()->route('employee.login')->with('success', 'Register SuccessFully');
            } elseif ($users->role === 'manager') {
                return redirect()->route('manager.login')->with('success', 'Register SuccessFully');
            }
        } else {
            return redirect()->back()->with('error', 'Register Failed');
        }
    }
}
