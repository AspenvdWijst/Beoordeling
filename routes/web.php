<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ApprovalController;
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
});

require __DIR__.'/auth.php';
