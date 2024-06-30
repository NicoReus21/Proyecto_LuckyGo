<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RaffletorController;
use App\Http\Controllers\ManageRaffletorsController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\AuthenticateRaffletor;
use App\Http\Middleware\AuthenticateAdmin;

Route::aliasMiddleware('auth.raffletor', AuthenticateRaffletor::class);
Route::aliasMiddleware('auth.admin', AuthenticateAdmin::class);

Route::get('/', function () {
    return view('main.main');
})->name('dashboard');

Route::get('dashboard', [AuthController::class, 'main'])->name('main');

// Rutas para la autenticación de usuarios.
Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('ticket/index', [TicketController::class, 'validateForm'])->name('ticketValidate');
Route::get('ticket/results', [TicketController::class, 'validate_ticket'])->name('validate_ticket');
Route::get('ticket/buy', [TicketController::class, 'buyForm'])->name('buyForm');//ticket
Route::post('ticket/buy', [TicketController::class, 'buy'])->name('ticket.buy');

// Rutas para usuario raffletor.
Route::middleware('auth.raffletor')->group(function () {
    // Gestión de credenciales
    Route::get('settings', [AuthController::class, 'settings'])->name('settings');
    Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');

    // Rutas para la gestión de raffles.
    Route::get('raffle', [RaffleController::class, 'showList'])->name('raffle.list');
    Route::post('raffle/register', [RaffleController::class, 'registerForm'])->name('raffle.register');
    Route::get('raffle/register', [RaffleController::class, 'registerForm'])->name('registerForm');
    Route::post('raffle/update', [RaffleController::class, 'updateWinner'])->name('raffle.updateWinner');    
});

// Rutas para usuario admin.
Route::middleware('auth.admin')->group(function () {
    // Gestión de credenciales
    Route::get('settings', [AuthController::class, 'settings'])->name('settings');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('auth.settings');
    
    // Rutas para la gestión de raffletors
    Route::get('raffletors', [RaffletorController::class, 'index'])->name('raffletors');
    Route::get('raffletors/manage', [ManageRaffletorsController::class, 'showManageForm'])->name('raffletors.manage');
    Route::post('raffletors/manage', [ManageRaffletorsController::class, 'manage'])->name('raffletors.manage.post');
    Route::get('raffletors/create', [RaffletorController::class, 'create'])->name('raffletors.create');
    Route::get('raffletors/list', [RaffletorController::class, 'list'])->name('raffletors.list');
    Route::post('raffletors/create', [RaffletorController::class, 'store'])->name('raffletors.store');
});
