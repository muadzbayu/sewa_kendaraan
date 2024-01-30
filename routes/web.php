<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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


// customer
Route::post('customer/filter_customer/{lokasi}/{date_start}/{date_end}', 'CustomerController@filter_customer')->name('customer.filter_customer');
Route::resource('customer', CustomerController::class);
