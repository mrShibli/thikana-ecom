<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Product\ProductCategoryController;

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
    return view('clientside.index');
});

Route::post('/check-email', [AdminController::class, 'checkemail'])->name('check.email');


Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Controller
    Route::get('/dashboard', [AdminController::class, 'admin'])->name('admin');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Dashboard Users Controller
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/usersedit', [AdminController::class, 'usersedit'])->name('users.edit');
    Route::delete('/usersdestroy', [AdminController::class, 'usersdestroy'])->name('users.destroy');

    // Dashboard Product Controller
    Route::get('/product_categories', [ProductCategoryController::class, 'index'])->name('product_categories.index');
    Route::get('/product_categories/create', [ProductCategoryController::class, 'create'])->name('product_categories.create');
    Route::post('/product_categories', [ProductCategoryController::class, 'store'])->name('product_categories.store');
    Route::get('/product_categories/{id}/edit', [ProductCategoryController::class, 'edit'])->name('product_categories.edit');
    Route::put('/product_categories/{id}', [ProductCategoryController::class, 'update'])->name('product_categories.update');
    Route::delete('/product_categories/{id}', [ProductCategoryController::class, 'destroy'])->name('product_categories.destroy');

    // Dashboard Product Controller
    Route::get('/product', [AdminController::class, 'index'])->name('product.index');
    Route::get('/product/create', [AdminController::class, 'productCreate'])->name('product.create');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');