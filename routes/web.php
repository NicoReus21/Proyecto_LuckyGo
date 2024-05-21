<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RaffletorController;
use Illuminate\Database\Query\IndexHint;
use App\Http\Controllers\RaffleController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('raffletors/login', [RaffletorController::class, 'welcome'])->name('welcome');

Route::get('raffle/register', [RaffleController::class, 'registerForm'])->name('registerForm');
Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('raffletors', [RaffletorController::class, 'index'])->name('raffletors');
    Route::get('raffletors/create', [RaffletorController::class, 'create'])->name('raffletors.create');
    Route::post('raffletors/create', [RaffletorController::class, 'store'])->name('raffletors.store');
    
});


/*
Route::middleware('raffletors')->group(function () {
    Route::get('raffletors/login', [RaffletorController::class, 'welcome'])->name('welcome');
    Route::post('raffletors/login', [RaffletorController::class, 'logout'])->name('logout');
});
*/
