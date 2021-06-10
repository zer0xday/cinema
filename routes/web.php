<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlacesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MoviesController::class, 'index'])->name('movies');
Route::get('places', [PlacesController::class, 'index'])->name('places');
Route::get('order', [OrderController::class, 'index'])->name('order');
Route::get('confirmation', [ConfirmationController::class, 'index'])->name('confirmation');

Route::prefix('store')->group(function () {
    Route::post('movie', [MoviesController::class, 'store'])->name('storeMovie');
    Route::post('places', [PlacesController::class, 'store'])->name('storePlaces');
    Route::post('order', [OrderController::class, 'store'])->name('storeOrder');
});
