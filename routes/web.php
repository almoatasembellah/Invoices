<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::resource('/invoices', InvoicesController::class);
Route::resource('/sections', SectionController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {return view('auth.login');});
Route::get('/{page}', [AdminController::class, 'index']);

Auth::routes();

