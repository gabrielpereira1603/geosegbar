<?php

use App\Http\Middleware\Auth\RequiredLoginMiddleware;
use App\Http\Middleware\Auth\RequiredNoLoginMiddleware;
use App\Http\Middleware\Auth\TwoFactorSession;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\TwoFactorAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(RequiredNoLoginMiddleware::class)->group(function () {
    Route::get('login', Login::class)
        ->name('login');
});

Route::middleware('guest')->group(function () {
    Route::get('token-two-factor', TwoFactorAuth::class)
        ->name('token-two-factor')->middleware(TwoFactorSession::class);
});

