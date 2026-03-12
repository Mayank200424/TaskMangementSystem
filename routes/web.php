<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Authentication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [Authentication::class, 'registerform'])->name('register');
Route::post('register', [Authentication::class, 'register'])->name('register-process');

Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('login-process', [AdminController::class, 'login'])->name('admin.login-process');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

Route::prefix('employee')->group(function () {

    Route::middleware('guest:employee')->group(function () {
        Route::get('login', [EmployeeController::class, 'index'])->name('employee.login');
        Route::post('login-process', [EmployeeController::class, 'login'])->name('employee.login-process');
    });

    Route::middleware('employee.auth')->group(function () {
        Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
        Route::post('logout', [EmployeeController::class, 'logout'])->name('employee.logout');
        Route::get('edit/{id}', [Employeecontroller::class, 'edit'])->name('employee.edit');
        Route::put('update/{id}', [Employeecontroller::class, 'update'])->name('employee.update');
    });
});


Route::prefix('manager')->group(function () {

    Route::middleware('guest:manager')->group(function () {
        Route::get('login', [ManagerController::class, 'index'])->name('manager.login');
        Route::post('login-process', [ManagerController::class, 'login'])->name('manager.login-process');
    });

    Route::middleware('manager.auth')->group(function () {
        Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
        Route::post('logout', [ManagerController::class, 'logout'])->name('manager.logout');

        Route::get('create-task', [ManagerController::class, 'createTaskForm'])->name('manager.create-task.form');
        Route::post('create-task', [ManagerController::class, 'create'])->name('manager.create-task');
        Route::get('edit/{id}', [ManagerController::class, 'edit'])->name('task.edit');
        Route::put('update/{id}', [ManagerController::class, 'update'])->name('task.update');
    });
});
