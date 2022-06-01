<?php

use App\Http\Controllers\LoadTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PriceController;


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



Auth::routes();

Route::get('/', [LocationController::class, 'index']);
Route::get('/home', [LocationController::class, 'index']);
Route::POST('/home',[ParkingController::class, 'HandleReservation']);
Route::get('/dashboard',[LoadTransactionController::class, 'index']);
Route::get('/dashboardcustomer',[LoadTransactionController::class, 'indexcustomer']);
Route::get('/dashboardgoverment',[LoadTransactionController::class, 'indexgoverment']);
Route::get('/pricetest', [PriceController::class, 'index']);

//Ajax calls

Route::get('/fetch-numberboards', [LocationController::class, 'fetchnumberboards']);
Route::get('/end-session', [LocationController::class, 'endsession']);
