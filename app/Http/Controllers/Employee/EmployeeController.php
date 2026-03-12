<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
        $check = $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::guard('employee')->attempt($check)) {
            if (Auth::guard('employee')->user()->role != 'employee') {
                Auth::guard('employee')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('employee.login')->with('error', 'You are not authorized to access this page.');
            }
            $request->session()->regenerate();

            return redirect()->route('employee.dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->route('employee.login')->with('error', 'Either Email or Password Is Incorrect');
        }
    }

    public function dashboard()
    {
        $employeeId = Auth::guard('employee')->id();

        $tasks = Task::where('user_id', $employeeId)->get();

        return view('employee.dashboard', compact('tasks'));
    }

    public function logout(Request $request){
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employee.login')->with('success', 'Logged out successfully');
    }

    public function edit($id){
        $task = Task::where('id', $id)->where('user_id', Auth::guard('employee')->id())->firstOrFail();


        return view('employee.task_edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:in_progress,completed,pending'
        ]);

        $task = Task::where('id', $id)->where('user_id', Auth::guard('employee')->id())->firstOrFail();

        $task->status = $request->status;
        $task->save();

        return redirect()->route('employee.dashboard')->with('success', 'Task Status Updated Successfully');
    }


}
