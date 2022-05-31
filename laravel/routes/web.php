<?php

use App\Http\Controllers\LoadTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ParkingController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [LocationController::class, 'index']);
Route::POST('/home',[ParkingController::class, 'HandleReservation']);
Route::get('/dashboard',[LoadTransactionController::class, 'index']);
Route::get('/dashboardcustomer',[LoadTransactionController::class, 'indexcustomer']);
Route::get('/dashboardgoverment',[LoadTransactionController::class, 'indexgoverment']);

Route::get('/fetch-numberboards', [LocationController::class, 'ajax']);
