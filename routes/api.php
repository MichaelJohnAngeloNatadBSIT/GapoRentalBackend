<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\AcceptedScheduleController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\AcceptedSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
Route::get('/userById/{userId}', [UserController::class, 'getUserById']);
Route::put('/change-password/{id}', [UserController::class, 'changePassword']);

Route::post('/updateImage/{id}', [UserController::class, 'updateImage']);

Route::get('/images/{filename}', function ($filename){
    $path = storage_path('app/public/userImage/' .$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);


        return response($file, 200)->header('Content-Type', $type);
    });
    
Route::apiResource('products', ProductController::class);
Route::post('/add-product/{user_id}', [ProductController::class, 'addProduct']);
Route::get('/getProductById/{id}', [ProductController::class, 'getProductWithId']);
Route::get('/getProductByUserId/{id}', [ProductController::class, 'getProductWithUserId']);
Route::post('/updateHouseImage/{id}', [ProductController::class, 'updateHouseImage']);
Route::get('/imagesHouses/{filename}', function ($filename){
    $path = storage_path('app/public/houseImage/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);


        return response($file, 200)->header('Content-Type', $type);
    });
Route::post('/schedule/{user_id}/{product_id}/{product_name}/{product_price}/{product_img}/{post_user_id}', [ScheduleController::class, 'schedule']);
Route::get('/schedule/{user_id}', [ScheduleController::class, 'getSchedule']);
Route::delete('/delete-schedule/{schedule_id}',[ScheduleController::class, 'deleteSchedule']);
Route::get('/schedule-post-user-id/{post_user_id}', [ScheduleController::class, 'getScheduleWithPostUserId']);

Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);

Route::post('/createAcceptedSchedule/{user_id}/{product_id}/{schedule_id}/{schedule_date}', [AcceptedScheduleController::class, 'createAcceptedSchedule']);
