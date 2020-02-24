<?php

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

use App\Http\Controllers\InvoicePenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenerimaanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("obat", class_basename(ObatController::class));
Route::resource("invoice_penjualan", class_basename(InvoicePenjualanController::class));
Route::resource("penerimaan", class_basename(PenerimaanController::class));
