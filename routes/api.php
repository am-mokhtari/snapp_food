<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//  Apis When Logged In:
Route::middleware('auth:sanctum')->group(function () {
    //  User Apis
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::patch("/user", [UserController::class, 'updateInfo']);

    //  Addresses Apis
    Route::controller(AddressController::class)
        ->group(function () {
            Route::get("/addresses", 'show');
            Route::post("/addresses", 'store');
            Route::post("/addresses/{address_id}", 'update')->whereNumber('address_id');
        });

    //    Restaurant Apis
    Route::controller(RestaurantController::class)
        ->group(function () {
            Route::get('/restaurants', 'index');
            Route::get('/restaurants/{restaurant_id}', 'show')->whereNumber('restaurant_id');
        });

    //    Carts Apis
    Route::prefix('/carts')
        ->controller(CartController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/add', 'store');
            Route::patch('/add', 'update');
            Route::get('/{cart_id}', 'show')->whereNumber("cart_id");
            Route::post('/{cart_id}/pay', 'pay')->whereNumber("cart_id");
        });

    //     Comments
    Route::controller(CommentController::class)
        ->group(function () {
            Route::get('/comments', 'index');
            Route::post('/comments', 'store');
        });
});


//  Apis Without Login:
//      Foods Api
Route::get('/restaurants/{restaurant_id}/foods', [FoodController::class, 'show']);

//      Authenticate Apis
Route::controller(UserController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
    });
