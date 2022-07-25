<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\AcceptedScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
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

// Route::get('/', [UserController::class, 'index']);

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

Route::get('/getProductsWithoutUserId/{id}', [ProductController::class, 'getProductsWithoutUserId']);

Route::get('/getProductWithUserId/{id}', [ProductController::class, 'getProductWithUserId']);

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

Route::get('/get_approved_schedule/{user_id}', [AcceptedSchedule::class, 'getApprovedSchedule']);

Route::get('/get_user/{user_id}', [ScheduleController::class, 'getUserWithId']);

Route::get('/get_product/{product_id}', [ScheduleController::class, 'getProductWithId']);

Route::delete('/delete-schedule/{schedule_id}',[ScheduleController::class, 'deleteSchedule']);

Route::get('/schedule-post-user-id/{post_user_id}', [ScheduleController::class, 'getScheduleWithPostUserId']);

Route::get('/approved-schedule-post-user-id/{post_user_id}', [ScheduleController::class, 'getApprovedScheduleWithPostUserId']);

Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);

Route::post('/createAcceptedSchedule/{user_id}/{product_id}/{schedule_id}/{post_user_id}/{schedule_date}', [AcceptedScheduleController::class, 'createAcceptedSchedule']);

Route::get('/getAcceptedScheduleById/{user_id}', [AcceptedScheduleController::class, 'getAcceptedScheduleById']);


// Route::get('/', [AdminController::class, 'user_list']);

// Route::get('/second_page', [HomeController::class, 'second_page']);

Route::get('/create_form', [AdminController::class, 'create_user']);

Route::post('/create_user', [AdminController::class, 'store']);

Route::get('/user_list', [AdminController::class, 'user_list']);

Route::get('/update_form/{user}', [AdminController::class, 'update_form']);

Route::put('/update_user/{user}', [AdminController::class, 'update_user']);

Route::get('/delete_user/{user}', [AdminController::class, 'destroy']);

Route::get('/', [AdminController::class, 'index'])->name('login');

Route::post('post-login', [AdminController::class, 'postLogin'])->name('login.post'); 

Route::get('registration', [AdminController::class, 'registration'])->name('register');

Route::post('post-registration', [AdminController::class, 'postRegistration'])->name('register.post'); 

Route::get('update_profile_form', [AdminController::class, 'update_admin_profile_form']);

Route::put('update_admin/{admin}', [AdminController::class, 'update_admin']);

Route::post('update_admin_image/{id}', [AdminController::class, 'update_image']);

Route::get('/admin_image/{filename}', function ($filename){
    $path = storage_path('app/public/adminImage/' .$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);


        return response($file, 200)->header('Content-Type', $type);
    });

Route::get('dashboard', [AdminController::class, 'dashboard']); 



Route::get('logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/house_list', [AdminController::class, 'houses']);

Route::get('/update_house_form/{product}', [AdminController::class, 'update_house_form']);

Route::put('/update_house/{product}', [AdminController::class, 'update_house']);

Route::get('/delete_product/{product}', [AdminController::class, 'delete_product']);

Route::get('/create_house_form', [AdminController::class, 'create_house']);

Route::post('/create_house', [AdminController::class, 'create_post_house']);

Route::get('/schedule_list', [AdminController::class, 'schedules']);

Route::get('/update_schedule_form/{schedule}', [AdminController::class, 'update_schedule_form']);

Route::put('/update_schedule/{schedule}', [AdminController::class, 'update_schedule']);

Route::post('/record_sale/{schedule_id}/{user_id}/{product_id}/{product_name}/{product_price}/{product_img}/{post_user_id}', [SalesController::class, 'recordSale']);

Route::get('/sale_list', [AdminController::class, 'sales']);

// Route::get('/forget-password', 'ForgotPasswordController@getEmail');

// Route::get('/forget-password', [ChangePasswordController::class, 'getEmail']);

// Route::post('/forget-password', [ChangePasswordController::class, 'postEmail']);

// Route::get('/forget-password', [ChangePasswordController::class, 'getPassword']);

// Route::post('/forget-password', [ChangePasswordController::class, 'updatePassword']);

Route::get('forget-password', [ChangePasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ChangePasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ChangePasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ChangePasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');