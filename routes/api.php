<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //  addresses apis
    Route::get("/addresses", [AddressController::class, 'show']);
    Route::post("/addresses", [AddressController::class, 'store']);
    Route::post("/addresses/{address_id}", [AddressController::class, 'update']);

    //    user api
    Route::patch("/user", [UserController::class, 'updateInfo']);

    //    restaurant apis
    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{restaurant_id}', [RestaurantController::class, 'show']);

    //    Carts apis
    Route::prefix('/carts')
        ->controller(CartController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/add', 'store');
            Route::patch('/add', 'update');
            Route::get('/{cart}', 'show')->whereNumber("cart");
            Route::post('/{cart}/pay', 'pay')->whereNumber("cart");
        });

    //     Comments

    Route::get('/comments', [CommentController::class, 'index']);
});

//    Foods api
    Route::get('/restaurants/{restaurant_id}/foods', [FoodController::class, 'show']);

//  authenticate apis
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout']);
