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
    return view('home');
});

Route::get('/dashboard', function () {
    $page = \Illuminate\Support\Facades\Auth::user()->role;
    return redirect('/dashboard/' . $page);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/dashboard/admin', \App\Http\Controllers\AdminController::class);
    Route::resource('/dashboard/seller', \App\Http\Controllers\SellerController::class);

    Route::post('/restaurantTypeDelete', [\App\Http\Controllers\RestaurantTypeController::class, 'destroy'])
    ->name('restaurantTypeDelete');
});

require __DIR__.'/auth.php';
