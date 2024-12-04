<?php

use App\Livewire\Auth\Register;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Volt::route('/users', 'users.index');

Route::get('/', Welcome::class);

Route::get('/register', Register::class)->name('auth.register');

Route::get('/logout', fn() => Auth::logout());




