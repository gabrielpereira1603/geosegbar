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

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/two-factor-authentication', function (Request $request) {
        return response()->json([
            'enabled' => !empty($request->user()->two_factor_secret),
        ]);
    });

    Route::post('/user/two-factor-authentication', function (Request $request) {
        $request->user()->enableTwoFactorAuthentication();
        return back()->with('status', '2FA ativada com sucesso!');
    });

    Route::delete('/user/two-factor-authentication', function (Request $request) {
        $request->user()->disableTwoFactorAuthentication();
        return back()->with('status', '2FA desativada com sucesso!');
    });
});
