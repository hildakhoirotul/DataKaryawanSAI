<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::controller(UserController::class)->group(function () {
    Route::get('/home', 'index')->middleware('is_user')->name('/home');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('is_admin')->name('/dashboard');
    Route::get('/change', 'showChangePassword')->middleware('is_admin')->name('/change');
});