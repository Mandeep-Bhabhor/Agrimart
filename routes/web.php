<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    return view('home');
});


Route::get('/about',[UserController::class,'about']);


Route::get('/contact',[UserController::class,'contact']);

Route::view('register','register');

Route::post('adduser',[UserController::class,'adduser']);

Route::get('login',[UserController::class,'login']);

Route::post('ulogin',[UserController::class,'ulogin']);
Route::get('/logout',[UserController::class,'ulogout']);

Route::get('admindashboard',[UserController::class,'admindash']);

Route::get('/audit',[UserController::class,'audit']);