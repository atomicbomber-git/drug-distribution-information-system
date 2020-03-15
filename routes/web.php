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

use App\Http\Controllers\StockGabunganIndex;
use App\Http\Controllers\InvoicePenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\StockGabunganShow;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("obat", class_basename(ObatController::class));
Route::resource("invoice_penjualan", class_basename(InvoicePenjualanController::class));
Route::resource("penerimaan", class_basename(PenerimaanController::class));

Route::get("stock_gabungan/index", class_basename(StockGabunganIndex::class))->name("stock_gabungan.index");
Route::get("stock_gabungan/{obat}", class_basename(StockGabunganShow::class))->name("stock_gabungan.show");

if (App::environment() === "local") {
    Route::get('logs', [LogViewerController::class, "index"]);
}
