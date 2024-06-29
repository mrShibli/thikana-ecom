<?php

    use App\Http\Controllers\Client\OthersController;
    use App\Http\Controllers\Admin\ProductControler as AdminProductControler;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\Client\OrderController;
    use App\Http\Controllers\Client\ProductControler;
    use App\Http\Controllers\Product\ProductCategoryController;
    use App\Models\Product;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

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

Route::get('/product/{id}/{slug}', [ProductControler::class, 'index'])->name('product.single');
Route::controller (OthersController::class)->group (function (){
    Route::get ("/shop", 'shop')->name ("shop");
    Route::get ("/refund-returns","refund")->name ("refund-returns");
    Route::get ("/privacy-policy","policy")->name ("privacy-policy");
    Route::get('/',"index" )->name ("index");
});
Route::post('/check-email', [AdminController::class, 'checkemail'])->name('check.email');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::get('/cart/store', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
//Order Controller
Route::get('/order', [OrderController::class, 'index'])->name('order.index')->middleware('auth');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store')->middleware('auth');

//middleware(['auth'])->
Route::prefix('admin')->group(function () {
    Route::get ("/",function (){
        return redirect()->route('admin');
    });
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
    Route::get('/product', [AdminProductControler::class, 'index'])->name('product.index');
    // Route::get('/product/create', [AdminController::class, 'productCreate'])->name('product.create');

    //caht gpt 
    Route::get('/products/create', [AdminProductControler::class, 'productCreate'])->name('product.create');
    Route::post('/products', [AdminProductControler::class, 'store'])->name('products.store');
    //orders
    Route::name('admin.')->group(function () {
        Route::resource ('orders', OrderController::class);
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
