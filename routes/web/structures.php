<?php

use App\Http\Middleware\Auth\RequiredLoginMiddleware;
use App\Livewire\Pages\Structures\HomeStructures;
use App\Livewire\Pages\Users\HomeUsers;
use Illuminate\Support\Facades\Route;


Route::middleware(RequiredLoginMiddleware::class)->group(function () {
    Route::get('structures', HomeStructures::class)
        ->name('structures');
});

