<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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



// product routes
Route::middleware(['auth', Adminmiddleware::class])->group(function () {

Route::get('/createproducts', [ProductController::class, 'showform']);
Route::post('/createproducts', [ProductController::class, 'store']);
Route::get('/adminproducts', [ProductController::class, 'adminproduct']);
Route::get('{id}/editproducts', [ProductController::class, 'edit']);
Route::put('{id}/adminproducts', [ProductController::class, 'update']);
Route::get('{id}/deleteproducts', [ProductController::class, 'delete']);

});
Route::get('/products', [ProductController::class, 'index']);
Route::post('/order', [ProductController::class, 'order']);

Route::get('/vieworder', [ProductController::class, 'vieworder']);
Route::post('/vieworder/{product_name}/{id}', [ProductController::class, 'updateorder']);
Route::post('{id}/placeOrder', [ProductController::class, 'placeorder']);
//Route::post('{id}/place-order', [ProductController::class, 'placeOrder'])->name('placeOrder');
Route::get('downloadBill/{user_name}', [ProductController::class, 'downloadBill'])->name('download.bill');


//category routes 

Route::middleware(['auth', Adminmiddleware::class])->group(function ()
{

    Route::get('/admincategory', [CategoryController::class, 'viewcat']);
    Route::get('/addcategory', [CategoryController::class, 'showform']);
    Route::post('/addcategory', [CategoryController::class, 'store']);
    Route::get('{id}/editcategory', [CategoryController::class, 'edit']);
    Route::put('{id}/editcategory', [CategoryController::class, 'update']);
    Route::get('{id}/deletecategory', [CategoryController::class, 'delete']);



});