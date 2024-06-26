<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PollController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::middleware('role:operator')->get('/operator', [HomeController::class, 'index'])->name('operator');
    Route::middleware('role:admin')->get('/admin', [HomeController::class, 'admin'])->name('admin');
    Route::resource('/upload', ImageController::class)->middleware('auth');
    Route::resource('/admin', AdminController::class)->middleware('auth');
    Route::resource('/ubahPassword', UserController::class);

    Route::get('/create-poll', [PollController::class, 'createPoll']);
    Route::post('/poll/{poll}/vote', [PollController::class, 'vote'])->name('poll.vote');
    Route::get('/poll', [PollController::class, 'showPoll'])->name('poll.show');

    Route::get('/admin/poll/create', [PollController::class, 'createPollForm'])->name('admin.poll.create');
    Route::post('/admin/poll', [PollController::class, 'storePoll'])->name('admin.poll.store');
    Route::get('/admin/polls', [PollController::class, 'TampilData']);

    Route::delete('/admin/polls/{poll}', [ImageController::class, 'destroy'])->name('admin.polls.destroy');
});
