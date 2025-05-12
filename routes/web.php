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

    Route::post('/items/{item}/approve', [ApprovalController::class, 'approve'])->name('items.approve');
    Route::post('/items/{item}/submit', [ApprovalController::class, 'submit'])->name('items.submit');
});

require __DIR__.'/auth.php';
