<?php

use App\Http\Controllers\AppController;
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

Route::get('/', [AppController::class, 'movies'])->name('movies');
Route::post('places', [AppController::class, 'places'])->name('places');
Route::post('order', [AppController::class, 'order'])->name('order');
Route::post('store', [AppController::class, 'store'])->name('store');
