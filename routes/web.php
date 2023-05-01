<?php

use App\Http\Controllers\ProfileController;
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
    $role = \Illuminate\Support\Facades\Auth::user()->role;
    return redirect('dashboard/' . $role);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    dashboard
    Route::resource('/dashboard/admin', \App\Http\Controllers\AdminController::class);
    Route::resource('/dashboard/seller', \App\Http\Controllers\SellerController::class);

//    restaurant type
    Route::get('/restaurantTypeEdit/{id}', [\App\Http\Controllers\RestaurantTypeController::class, 'edit'])
        ->name('restaurantTypeEdit');
    Route::post('/restaurantTypeEdit', [\App\Http\Controllers\RestaurantTypeController::class, 'update'])
        ->name('restaurantTypeEdit');

    Route::post('/restaurantTypeDelete', [\App\Http\Controllers\RestaurantTypeController::class, 'destroy'])
        ->name('restaurantTypeDelete');

    Route::get('/newRestaurantType', [\App\Http\Controllers\RestaurantTypeController::class, 'create'])
        ->name('newRestaurantType');
    Route::post('/newRestaurantType', [\App\Http\Controllers\RestaurantTypeController::class, 'store'])
        ->name('newRestaurantType');

//    food category
    Route::get('/foodCategoryEdit/{id}', [\App\Http\Controllers\FoodCategoryController::class, 'edit'])
        ->name('foodCategoryEdit');
    Route::post('/foodCategoryEdit', [\App\Http\Controllers\FoodCategoryController::class, 'update'])
        ->name('foodCategoryEdit');

    Route::post('/foodCategoryDelete', [\App\Http\Controllers\FoodCategoryController::class, 'destroy'])
        ->name('foodCategoryDelete');

    Route::get('/newFoodCategory', [\App\Http\Controllers\FoodCategoryController::class, 'create'])
        ->name('newFoodCategory');
    Route::post('/newFoodCategory', [\App\Http\Controllers\FoodCategoryController::class, 'store'])
        ->name('newFoodCategory');

//    discount
    Route::get('/discountCodeEdit/{id}', [\App\Http\Controllers\DiscountCodeController::class, 'edit'])
        ->name('discountCodeEdit');
    Route::post('/discountCodeEdit', [\App\Http\Controllers\DiscountCodeController::class, 'update'])
        ->name('discountCodeEdit');

    Route::post('/discountCodeDelete', [\App\Http\Controllers\DiscountCodeController::class, 'destroy'])
        ->name('discountCodeDelete');

    Route::get('/newDiscount', [\App\Http\Controllers\DiscountCodeController::class, 'create'])
        ->name('newDiscount');
    Route::post('/newDiscount', [\App\Http\Controllers\DiscountCodeController::class, 'store'])
        ->name('newDiscount');
});

require __DIR__ . '/auth.php';
