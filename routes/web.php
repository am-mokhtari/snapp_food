<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantTypeController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//  Intro
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    return redirect('dashboard/' . $role);
})->middleware(['auth', 'verified'])->name('dashboard');


//  Apis When Logged In:
Route::middleware('auth')->group(function () {

    //  Dashboards:
    Route::resource('/dashboard/admin', AdminController::class);
    Route::resource('/dashboard/seller', SellerController::class)
        ->middleware('exist.restaurant.info');


    //  Profile
    Route::controller(ProfileController::class)
        ->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });

    //  ADMIN {
    //      Restaurant Type
    Route::controller(RestaurantTypeController::class)
        ->group(function () {
            Route::get('/restaurantTypeEdit/{id}', 'edit')
                ->whereNumber('id')
                ->name('restaurantTypeEdit');

            Route::post('/restaurantTypeEdit', 'update')
                ->name('restaurantTypeEdit');

            Route::post('/restaurantTypeDelete', 'destroy')
                ->name('restaurantTypeDelete');

            Route::get('/newRestaurantType', 'create')
                ->name('newRestaurantType');

            Route::post('/newRestaurantType', 'store')
                ->name('newRestaurantType');
        });


    //      Food Category
    Route::controller(FoodCategoryController::class)
        ->group(function () {
            Route::get('/foodCategoryEdit/{id}', 'edit')
                ->whereNumber('id')
                ->name('foodCategoryEdit');

            Route::post('/foodCategoryEdit', 'update')
                ->name('foodCategoryEdit');

            Route::post('/foodCategoryDelete', 'destroy')
                ->name('foodCategoryDelete');

            Route::get('/newFoodCategory', 'create')
                ->name('newFoodCategory');

            Route::post('/newFoodCategory', 'store')
                ->name('newFoodCategory');
        });

    //      Discount
    Route::controller(DiscountCodeController::class)
        ->group(function () {
            Route::get('/discountCodeEdit/{id}', 'edit')
                ->whereNumber('id')
                ->name('discountCodeEdit');

            Route::post('/discountCodeEdit', 'update')
                ->name('discountCodeEdit');

            Route::post('/discountCodeDelete', 'destroy')
                ->name('discountCodeDelete');

            Route::get('/newDiscount', 'create')
                ->name('newDiscount');

            Route::post('/newDiscount', 'store')
                ->name('newDiscount');
        });
//    } End Of Admin Routs
});

//  SELLER
//      Restaurant Basic Info
Route::get('/restaurant/info/{id}', [SellerController::class, 'edit'])
    ->whereNumber('id')
    ->name('restaurant.info.edit');

Route::post('/restaurant/{id}/info', [SellerController::class, 'update'])
    ->whereNumber('id');

require __DIR__ . '/auth.php';
