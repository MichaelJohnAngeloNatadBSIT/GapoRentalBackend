<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// Route::get('/admin', [HomeController::class, 'index']);
// Route::get('/first_page', [HomeController::class, 'first_page']);
// Route::get('/second_page', [HomeController::class, 'second_page']);
// Route::get('/update_form/{user}', [AdminController::class, 'update_form']);


// Route::get('/admin', [HomeController::class, 'index']);

// Route::get('/second_page', [HomeController::class, 'second_page']);

// Route::get('/user_list', [AdminController::class, 'user_list']);

// Route::get('/update_form/{user}', [AdminController::class, 'update_form']);

// Route::put('/update_user/{user}', [AdminController::class, 'update_user']);
// // Route::view('admin', 'home');

// Route::get('admin', function () {
//     return view('home');
// });
