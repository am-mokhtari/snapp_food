<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //  addresses apis
    Route::get("/addresses", [\App\Http\Controllers\Api\AddressController::class, 'show']);
    Route::post("/addresses", [\App\Http\Controllers\Api\AddressController::class, 'store']);
    Route::post("/addresses/{address_id}", [\App\Http\Controllers\Api\AddressController::class, 'update']);
});

//  authenticate apis
Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
