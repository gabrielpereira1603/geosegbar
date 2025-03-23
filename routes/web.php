<?php

use App\Livewire\Pages\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('home', Home::class)
    ->name('home');

Route::get('logout', [\App\Http\Controllers\ProfileController::class, 'logout'])
    ->name('logout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



require __DIR__.'/auth.php';
require __DIR__.'/web/users.php';
require __DIR__.'/web/structures.php';
