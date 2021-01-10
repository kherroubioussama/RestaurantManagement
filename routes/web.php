<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('categories',CategoryController::class);
Route::resource('tables',TableController::class);
Route::resource('serveurs',ServantController::class);
Route::resource('menus',MenuController::class);
Route::resource('sales',SaleController::class);
Route::get('payments','App\Http\Controllers\PaymentController@index')->name('payments');
Route::get('reports','App\Http\Controllers\ReportController@index')->name('reports.index');
Route::post('reports/generate','App\Http\Controllers\ReportController@generate')->name('reports.generate');
Route::post('reports/export','App\Http\Controllers\ReportController@export')->name('reports.export');
