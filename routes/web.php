<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/', [RoleController::class, 'index'])->name('dashboard');
    Route::post('/grades/{grade}/approve', [ApprovalController::class, 'approve'])->name('grades.approve');
    Route::post('/grades/{grade}/submit', [ApprovalController::class, 'submit'])->name('grades.submit');

    Route::get('/user/{userid}', ['userid'])->name('users.add');

    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/save', [UserController::class, 'save'])->name('users.save');

    Route::get('/user/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/{user}/save', [UserController::class, 'save'])->name('users.save');
    Route::get('/user/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/subjects/{subject}', [StudentController::class, 'subject'])->name('student.subject');

    Route::get('/competentie', function (){
        return view('grading-form');
    })->name('grading-form')->middleware('auth');
});

require __DIR__.'/auth.php';
