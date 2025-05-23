<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



use App\Http\Controllers\RoleController;

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

Route::get('/', function () {
    return view('welcome');
});


// Cart Routes
Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
Route::put('/cart/update-item/{id}', [CartController::class, 'updateItem'])->name('cart.updateItem');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

// Coupon & Product Routes


Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');

Route::name("products.")->prefix("products")->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::name("categories.")->prefix("categories")->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});



Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');

    Route::resource('coupons', CouponController::class);


Route::name("roles.")->prefix("roles")->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/update/{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('destroy');
});



Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//users
Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', function ($id) {
    $user = User::find($id);
    return view('users.show', compact('user'));
})->name('users.show');


Route::name("reviews.")->prefix("reviews")->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    Route::post('/', [ReviewController::class, 'store'])->name('store');
    Route::get('/edit/{review}', [ReviewController::class, 'edit'])->name('edit');
    Route::post('/update/{review}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('destroy');
});


    Route::get('customerservice/home', function (Request $request) {
        return view('customerservice.home');
    });

Route::get('/customerservice/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/customerservice/ticket/store', [TicketController::class, 'store'])->name('ticket.store');


Route::get('/customerservice', [CustomerServiceController::class, 'home'])->name('customerservice.home');
    Route::get('/customerservice/faq', [CustomerServiceController::class, 'faq'])->name('customerservice.faq');
    Route::get('/customerservice/contact', [CustomerServiceController::class, 'contact'])->name('customerservice.contact');
    Route::post('/customerservice/contact', [CustomerServiceController::class, 'sendContact'])->name('customerservice.contact.send');
   
Route::get('/checkout', function (Request $request) {
    return view('checkout');
})->name('checkout');
Route::get('/checkout/index', [CheckoutController::class, 'checkout'])->name('checkout.index');
Route::get('/checkout/edit', [CheckoutController::class, 'edit'])->name('checkout.edit');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/admin/index', function (Request $request) {
    return view('admin.index');
})->name('admin.index');
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.products/edit');
Route::get('/admin/produts', [AdminController::class, 'products'])->name('admin.products');
Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
Route::get('/admin/tickets', [TicketController::class, 'tickets'])->name('admin.tickets');


Route::get('/admin/tickets/{id}/edit', [TicketController::class, 'edit'])->name('admin.tickets.edit');
Route::delete('/admin/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::put('/admin/tickets/update/{id}', [TicketController::class, 'update'])->name('admin.tickets.update');

