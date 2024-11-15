<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Adminmiddleware;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Public Routes
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact']);
Route::view('register', 'register');
Route::post('adduser', [UserController::class, 'adduser']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('ulogin', [UserController::class, 'ulogin']);

// Logout Route
Route::get('/logout', [UserController::class, 'ulogout'])->name('logout');

// Admin Dashboard and Audit Routes (Protected)
Route::middleware(['auth', Adminmiddleware::class])->group(function () {
    Route::get('admindash', [UserController::class, 'admindash'])->name('admindashboard');
    Route::get('/audit', [UserController::class, 'audit']);
    Route::get('/admindash', [UserController::class, 'admindash'])->name('back');
    Route::get('/sh', [UserController::class, 'sh']);

});
