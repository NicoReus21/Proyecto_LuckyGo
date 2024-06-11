<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RaffletorController;
use App\Http\Controllers\ManageRaffletorsController;
use App\Http\Controllers\RaffleController;
use Illuminate\Database\Query\IndexHint;
use App\Http\Middleware\AuthenticateRaffletor;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Controllers\TicketController;
//use App\Http\Middleware\RedirectIfRaffletorAuthenticated;

Route::aliasMiddleware('auth.raffletor', AuthenticateRaffletor::class);
Route::aliasMiddleware('auth.admin', AuthenticateAdmin::class);

Route::get('/', function () {
    return view('auth.login');
});

// Rutas para la autenticación de usuarios.
Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('ticket/buy', [TicketController::class, 'buyForm'])->name('ticket.buy');//ticket
Route::post('ticket/buy', [TicketController::class, 'buy'])->name('ticket.buy.post');

// Rutas para usuario raffletor.
Route::middleware('auth.raffletor')->group(function () {
    
    // Rutas para la gestión de raffles.
    Route::get('raffle', [RaffleController::class, 'showList'])->name('raffle.list');
    //Route::post('raffle', [RaffleController::class, 'showList'])->name('raffle.list');
    Route::post('/raffle/register', [RaffleController::class, 'registerForm'])->name('raffle.register');
    Route::get('raffle/register', [RaffleController::class, 'registerForm'])->name('registerForm');
    Route::post('raffle/update', [RaffleController::class, 'updateWinner'])->name('raffle.updateWinner');
});

// Rutas para usuario admin.
Route::middleware('auth.admin')->group(function () {
    
    // Rutas para la gestión de raffletors
    Route::get('raffletors', [RaffletorController::class, 'index'])->name('raffletors');
    Route::get('raffletors/manage', [ManageRaffletorsController::class, 'showManageForm'])->name('raffletors.manage');
    Route::post('raffletors/manage', [ManageRaffletorsController::class, 'manage'])->name('raffletors.manage.post');
    Route::get('raffletors/create', [RaffletorController::class, 'create'])->name('raffletors.create');
    Route::get('raffletors/list', [RaffletorController::class, 'list'])->name('raffletors.list');
    Route::post('raffletors/create', [RaffletorController::class, 'store'])->name('raffletors.store');
});