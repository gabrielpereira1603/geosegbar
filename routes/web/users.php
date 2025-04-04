<?php

use App\Http\Middleware\Auth\RequiredLoginMiddleware;
use App\Livewire\Pages\Users\EditUsers;
use App\Livewire\Pages\Users\HomeUsers;
use Illuminate\Support\Facades\Route;


Route::middleware(RequiredLoginMiddleware::class)->group(function () {
    Route::get('users', HomeUsers::class)
        ->name('users');

    Route::get('users/edit/{user_id}', EditUsers::class)
        ->name('users.edit');
});

