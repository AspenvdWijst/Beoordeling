<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
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


    Route::get('/student/subjects/{subject}', [StudentController::class, 'subject'])->name('student.subject');
    Route::get('/teacher/subjects/{subject}', [TeacherController::class, 'subject'])->name('teacher.subject');
    Route::get('/teacher/subjects/{subject}/assignments/new', [TeacherController::class, 'addAssignment'])->name('new.assignment');
    Route::get('/teacher/subjects/{subject}/assignments/{assignment}', [TeacherController::class, 'assignment'])->name('teacher.assignment');
    Route::get('/teacher/subjects/{subject}/students/{student}', [SubjectController::class, 'student'])->name('add.student.subject');


    Route::get('/competentie', function (){
        return view('grading-form');
    })->name('grading-form')->middleware('auth');
});

require __DIR__.'/auth.php';
