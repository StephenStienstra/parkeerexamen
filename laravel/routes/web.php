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
Route::get('/pricetest', [PriceController::class, 'index']);

//Ajax calls

Route::get('/fetch-numberboards', [LocationController::class, 'fetchnumberboards']);
Route::get('/end-session', [LocationController::class, 'endsession']);

// Routes for the transactions on the dashboards
Route::get('/dashboard',[LoadTransactionController::class, 'GetAllTransactions']);
Route::get('/dashboardcustomer/select',[LoadTransactionController::class, 'GetCustomers']);
Route::get('/dashboardcustomer/{klantID}',[LoadTransactionController::class, 'RecieveCustomerTransactions']);
Route::get('/dashboardgoverment/select',[LoadTransactionController::class, 'GetGoverment']);
Route::get('/dashboardgoverment/{govermentID}',[LoadTransactionController::class, 'RecieveGovermentTransactions']);
