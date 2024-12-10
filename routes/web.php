<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


// Volt::route('/users', 'users.index');

Route::get('/login', Login::class)->name('auth.login');

Route::get('/register', Register::class)->name('auth.register');

Route::get('/logout', fn() => auth()->logout());

Route::middleware(['auth'])->group(function () {
    Route::get('/', Welcome::class)->name('dashboard');
});




