<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Middleware\Auth\EnsureTwoFactorTokenIsValid;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\TwoFactorAuth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Route::get('login', Login::class)
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware(EnsureTwoFactorTokenIsValid::class)->group(function () {
    Route::get('two-factor-token', TwoFactorAuth::class)->name('two-factor-token');
});

Volt::route('two-factor-token', 'pages.auth.two-factor-auth')
    ->name('two-factor-token')
    ->middleware([EnsureTwoFactorTokenIsValid::class]);

