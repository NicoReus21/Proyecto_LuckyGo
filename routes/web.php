<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\LoginController;

Route::view('\app',"app")->name('app');
Route::view('\register',"register")->name('register');
// Route::view('\app',"app")->name('app');


Route::get('/', function () {
    return view('layout/app');
});
