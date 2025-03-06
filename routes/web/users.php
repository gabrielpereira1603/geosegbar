<?php

use App\Livewire\Pages\Users\HomeUsers;
use Illuminate\Support\Facades\Route;

Route::get('users', HomeUsers::class)
    ->name('users');
