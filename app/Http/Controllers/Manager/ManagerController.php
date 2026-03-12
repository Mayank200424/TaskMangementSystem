<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.login');
    }

    public function login(Request $request)
    {
        $check = $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::guard('manager')->attempt($check)) {
            if (Auth::guard('manager')->user()->role != 'manager') {
                Auth::guard('manager')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('manager.login')->with('error', 'You are not authorized to access this page.');
            }
            $request->session()->regenerate();

            return redirect()->route('manager.dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->route('manager.login')->with('error', 'Either Email or Password Is Incorrect');
        }
    }

    public function employees()
    {
        $employees = User::where('role', 'employee')->get();

        return view('manager.create_task', compact('employees'));
    }

    public function createTaskForm()
    {
        $employees = User::where('role', '=', 'employee')->get();
        return view('manager.create_task', compact('employees'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'employee' => 'required',
            'status' => 'required|in:assigned'
        ]);

        $tasks = new Task();

        $tasks->title = $request->title;
        $tasks->description = $request->description;
        $tasks->due_date = $request->date;
        $tasks->user_id = $request->employee;
        $tasks->manager_id = Auth::guard('manager')->id();
        $tasks->status = $request->status;

        if ($tasks->save()) {
            return redirect()->route('manager.dashboard')->with('success', 'Task Add SuccessFully');
        } else {
            return redirect()->back()->with('error', 'Task Add Failed');
        }
    }

    public function dashboard()
    {
        $tasks = Task::with('user')->where('manager_id', Auth::guard('manager')->id())->get();
        return view('manager.dashboard', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->where('manager_id', Auth::guard('manager')->id())->firstOrFail();
        $employees = User::where('role', 'employee')->get();

        return view('manager.task_edit', compact('task','employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'employee' => 'required'
        ]);

        $task = Task::where('id', $id)->where('manager_id', Auth::guard('manager')->id())->firstOrFail();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->date;
        $task->user_id = $request->employee;
        $task->save();

        return redirect()->route('manager.dashboard')->with('success', 'Task Updated successfully');
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('manager.login')->with('success', 'Logged out successfully');
    }
}
