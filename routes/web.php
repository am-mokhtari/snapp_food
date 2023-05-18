<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantTypeController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    return redirect('dashboard/' . $role);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    dashboard
    Route::resource('/dashboard/admin', AdminController::class);
    Route::resource('/dashboard/seller', SellerController::class)
    ->middleware('exist.restaurant.info');
//    Route::resource('/dashboard/customer', \App\Http\Controllers\CustomerController::class);

//        ADMIN
//    restaurant type
    Route::get('/restaurantTypeEdit/{id}', [RestaurantTypeController::class, 'edit'])
        ->name('restaurantTypeEdit');
    Route::post('/restaurantTypeEdit', [RestaurantTypeController::class, 'update'])
        ->name('restaurantTypeEdit');

    Route::post('/restaurantTypeDelete', [RestaurantTypeController::class, 'destroy'])
        ->name('restaurantTypeDelete');

    Route::get('/newRestaurantType', [RestaurantTypeController::class, 'create'])
        ->name('newRestaurantType');
    Route::post('/newRestaurantType', [RestaurantTypeController::class, 'store'])
        ->name('newRestaurantType');

//    food category
    Route::get('/foodCategoryEdit/{id}', [FoodCategoryController::class, 'edit'])
        ->name('foodCategoryEdit');
    Route::post('/foodCategoryEdit', [FoodCategoryController::class, 'update'])
        ->name('foodCategoryEdit');

    Route::post('/foodCategoryDelete', [FoodCategoryController::class, 'destroy'])
        ->name('foodCategoryDelete');

    Route::get('/newFoodCategory', [FoodCategoryController::class, 'create'])
        ->name('newFoodCategory');
    Route::post('/newFoodCategory', [FoodCategoryController::class, 'store'])
        ->name('newFoodCategory');

//    discount
    Route::get('/discountCodeEdit/{id}', [DiscountCodeController::class, 'edit'])
        ->name('discountCodeEdit');
    Route::post('/discountCodeEdit', [DiscountCodeController::class, 'update'])
        ->name('discountCodeEdit');

    Route::post('/discountCodeDelete', [DiscountCodeController::class, 'destroy'])
        ->name('discountCodeDelete');

    Route::get('/newDiscount', [DiscountCodeController::class, 'create'])
        ->name('newDiscount');
    Route::post('/newDiscount', [DiscountCodeController::class, 'store'])
        ->name('newDiscount');
});

//   SELLER
//     restaurant info
Route::get('/restaurant/info/{id}', [SellerController::class, 'edit'])
    ->name('restaurant.info.edit');
Route::post('/restaurant/{id}/info', [SellerController::class, 'update']);

require __DIR__ . '/auth.php';
