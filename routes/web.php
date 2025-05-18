<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;




Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/', [RoleController::class, 'index'])->name('dashboard');

    Route::get('/competentie', function (){
        return view('grading-form');
    })->name('grading-form')->middleware('auth');
});

require __DIR__.'/auth.php';
