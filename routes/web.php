<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::middleware('role:operator')->get('/operator', [HomeController::class, 'index'])->name('operator');
    Route::middleware('role:admin')->get('/admin',[HomeController::class, 'admin'])->name('admin');
    Route::resource('/upload',ImageController::class)->middleware('auth');
    Route::resource('/admin',AdminController::class)->middleware('auth');
    Route::resource('/ubahPassword', UserController::class);

});
