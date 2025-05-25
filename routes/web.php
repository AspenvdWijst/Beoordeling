<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradingTemplateList;
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

    Route::get('/subjects/{subject}', [StudentController::class, 'subject'])->name('student.subject');

    Route::get('/competentie', function (){
        return view('grading-form');
    })->name('grading-form')->middleware('auth');

    Route::get('/grading-templates', [GradingTemplateList::class, 'index'])->name('grading-template.index');
    Route::get('/grading-template/{id}', [GradingTemplateList::class, 'show'])->name('grading-template.show');

});

require __DIR__.'/auth.php';
