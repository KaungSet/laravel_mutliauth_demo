<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MultiUserLoginController;
use App\Http\Controllers\UserController;
use App\Models\Admin;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('admin/login-form', [AdminController::class, 'showLoginForm'])->name('admin-login-form');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin-login');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin-logout');

// MultiUser Auth Login Form
Route::get('multiuserlogin/form', [MultiUserLoginController::class, 'showLoginForm'])->name('multiuserlogin-form');
Route::post('multiuserlogin', [MultiUserLoginController::class, 'multiuserLogin'])->name('multiuserlogin');

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/index', 'index')->name('admin-index');
        });
    });
});


Route::middleware('auth:web')->group(function () {
    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/index', 'index')->name('user-index');
        });
    });
});
