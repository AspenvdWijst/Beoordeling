<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/', [RoleController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
