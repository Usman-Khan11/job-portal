<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
// User Controllers
use App\Http\Controllers\Auth\LoginController as UserLoginController;
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


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AdminLoginController::class, 'login'])->name('login');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'home'])->name('home');

        // Category
        Route::get('categories', [CategoryController::class, 'index'])->name('category');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    });
});


Route::name('user.')->group(function () {
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login']);
    Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');
});


Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::middleware(['checkStatus'])->group(function () {
            Route::get('/dashboard', [UserController::class, 'home'])->name('home');
        });
    });
});
