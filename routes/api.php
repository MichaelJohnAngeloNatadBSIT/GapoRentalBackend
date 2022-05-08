<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', [UserController::class, 'index']);
Route::get('/get-data','HomeController@getdata')->middleware("cors");
Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');
Route::post('/register', [UserController::class, 'register']);

Route::put('/update/{id}', [UserController::class, 'update']);

Route::apiResource('products', ProductController::class,);