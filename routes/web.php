<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\OthersController;
use App\Http\Controllers\Client\ProductControler;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Admin\ProductControler as AdminProductControler;


Route::get('/send-sample-sms', [AdminController::class, 'sendSampleSMS']);

Route::get('set-cookies', [AdminController::class, 'setCookies']);
Route::get('get-cookies', [AdminController::class, 'getCookies']);
Route::get('del-cookies', [AdminController::class, 'delCookies']);

Route::get('/product/{id}/{slug}', [ProductControler::class, 'index'])->name('product.single');
Route::controller(OthersController::class)->group(function () {
    Route::get("/shop/{category?}/{sub_category?}", 'shop')->name("shop");
    Route::get('/', "index")->name("index");
    Route::get('/p/{slug}', "page")->name("page");
});
Route::post('/check-email', [AdminController::class, 'checkemail'])->name('check.email');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/buy/store', [CartController::class, 'buystore'])->name('buy.store');
Route::post('/buy/order', [CartController::class, 'buynoworder'])->name('buynow.order');
Route::post('/buy/verifyOtp', [CartController::class, 'verifyBuynowOtp'])->name('otp.verify.buynow');

//Order Controller
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/order/verifyOtp', [OrderController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/order/resendOtp', [OrderController::class, 'resendOtp'])->name('otp.resend');
Route::get('/thank-you/{order}', [OrderController::class, 'thankYou'])->name('order.thankYou');

Route::get('order/{orderId}/download-pdf', [OrderController::class, 'downloadOrderPDF'])->name('downloadOrderPDF');

// Route::middleware(['auth'])->prefix('account')->group(function () {
//     Route::get('/profile', [AccountController::class, 'show'])->name('account.show'); // Profile page
//     Route::get('/edit', [AccountController::class, 'edit'])->name('account.edit'); // Edit form
//     Route::post('/update', [AccountController::class, 'update'])->name('account.update'); // Update form submission
// });

Route::prefix('account')->name('account.')->group(function () {
    // Edit profile form (authentication required)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AccountController::class, 'show'])->name('show');
        Route::get('/edit', [AccountController::class, 'edit'])->name('edit');
        Route::post('/update', [AccountController::class, 'update'])->name('update');
    });
});



//middleware(['auth'])->
Route::prefix('admin')->middleware("auth")->group(function () {
    Route::get("/", function () {
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
    Route::get('/product_categories/{product_category}/edit', [
        ProductCategoryController::class,
        'edit'
    ])->name('product_categories.edit');
    Route::put('/product_categories/{product_category}', [
        ProductCategoryController::class,
        'update'
    ])->name('product_categories.update');
    Route::delete('/product_categories/{product_category}', [
        ProductCategoryController::class,
        'destroy'
    ])->name('product_categories.destroy');

    // Dashboard Product Controller
    Route::get('/product', [AdminProductControler::class, 'index'])->name('product.index');
    // Route::get('/product/create', [AdminController::class, 'productCreate'])->name('product.create');

    //caht gpt 
    Route::get('/products/create', [AdminProductControler::class, 'productCreate'])->name('product.create');
    Route::post('/products', [AdminProductControler::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [
        AdminProductControler::class,
        'edit'
    ])->name('products.edit');
    Route::put('/products/{product}', [
        AdminProductControler::class,
        'update'
    ])->name('products.update');
    Route::delete('/products/{product}', [
        AdminProductControler::class,
        'destroy'
    ])->name('products.destroy');
    //orders

    Route::name('admin.')->group(function () {
        Route::resource('orders', \App\Http\Controllers\OrderController::class);
        Route::resource('banners', \App\Http\Controllers\BannerController::class)->except("show");
        //sub category
        Route::resource("sub-categories", App\Http\Controllers\SubCategoryController::class)->except("show");
        //static pages
        Route::resource("pages", \App\Http\Controllers\PageController::class)->except("show");

        //settings page
        Route::get("/settings", [
            \App\Http\Controllers\SettingController::class,
            'index'
        ])->name("settings.index");
        Route::post("/settings/{id?}", [
            \App\Http\Controllers\SettingController::class,
            'store'
        ])->name("settings.store");
        //social
        Route::resource("socials", \App\Http\Controllers\SocialController::class)->except("show");
    });

    Route::get('/my-assigned-orders', [OrderController::class, 'asignedorders'])->name('asigned.orders');
    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


});

Route::get("/migrate", function () {
    Artisan::call("migrate");
    return "migrate";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
