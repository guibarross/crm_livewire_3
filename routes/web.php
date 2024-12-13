<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Password\Reset;
use App\Livewire\Auth\Recovery;
use App\Livewire\Auth\Register;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


// Volt::route('/users', 'users.index');

Route::get('/login', Login::class)->name('login');

Route::get('/register', Register::class)->name('auth.register');

Route::get('/logout', fn() => auth()->logout());

Route::get('/password/recovery', Recovery::class)->name('password.recovery');

Route::get('/password/reset', Reset::class)->name('password.reset');

Route::middleware(['auth'])->group(function () {
    Route::get('/', Welcome::class)->name('dashboard');
});




