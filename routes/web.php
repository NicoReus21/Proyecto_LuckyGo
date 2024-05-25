<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RaffletorController;
use App\Http\Controllers\RaffleController;
use Illuminate\Database\Query\IndexHint;
use App\Http\Middleware\AuthenticateRaffletor;
use App\Http\Middleware\RedirectIfRaffletorAuthenticated;

Route::aliasMiddleware('auth.raffletor', AuthenticateRaffletor::class);
Route::aliasMiddleware('guest.raffletor', RedirectIfRaffletorAuthenticated::class);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('/raffletors/manage', [ManageRaffletorsController::class, 'showManageForm'])->name('raffletors.manage');
Route::post('/raffletors/manage', [ManageRaffletorsController::class, 'manage'])->name('raffletors.manage.post');   

Route::middleware('auth')->group(function () {
    Route::get('raffletors', [RaffletorController::class, 'index'])->name('raffletors');
    Route::get('raffletors/create', [RaffletorController::class, 'create'])->name('raffletors.create');
    Route::post('raffletors/create', [RaffletorController::class, 'store'])->name('raffletors.store');
    
});

Route::middleware('auth.raffletor')->group(function () {
    Route::get('raffletors/login', [RaffletorController::class, 'welcome'])->name('welcome');
});

Route::middleware('guest.raffletor')->group(function () {
    Route::get('raffletorslogin', [AuthController::class, 'loginForm'])->name('loginForm');
});