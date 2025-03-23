<?php

use App\Http\Middleware\Auth\RequiredNoLoginMiddleware;
use App\Http\Middleware\Auth\TwoFactorSession;
use App\Livewire\Pages\Auth\ChangePassword;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\RecoverPassword;
use App\Livewire\Pages\Auth\TwoFactorAuth;
use App\Livewire\Pages\Auth\VerifyToken;
use Illuminate\Support\Facades\Route;

Route::middleware(RequiredNoLoginMiddleware::class)->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('recover_password', RecoverPassword::class)
        ->name('recover_password');
    Route::get('verify_token', VerifyToken::class)
        ->name('verify_token');

        Route::get('change_password', ChangePassword::class)
            ->name('change_password');
});


Route::middleware('guest')->group(function () {
    Route::get('token-two-factor', TwoFactorAuth::class)
        ->name('token-two-factor')->middleware(TwoFactorSession::class);
});

