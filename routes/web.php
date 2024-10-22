<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\CustomerController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'show'])->name('admin.dashboard');
        Route::get('/vendor/index', [VendorController::class, 'index'])->name('admin.vendor.index');
        Route::get('/vendor/create', [VendorController::class, 'create'])->name('admin.vendor.create');
        Route::post('/vendor/store', [VendorController::class, 'store'])->name('admin.vendor.store');
        Route::get('/vendor/edit', [VendorController::class, 'edit'])->name('admin.vendor.edit');
        Route::put('/vendor/update', [VendorController::class, 'update'])->name('admin.vendor.update');
        Route::delete('/vendor/delete', [VendorController::class, 'destroy'])->name('admin.vendor.destroy');

        Route::get('/product/index', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/product/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/product/update', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    });

    // Vendor routes
    Route::middleware('role:vendor')->group(function () {     
         Route::get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
        // Route::get('/vendor/products', [VendorController::class, 'products'])->name('vendor.products');
        // Route::post('/vendor/products', [VendorController::class, 'store'])->name('vendor.product.store');
    });

    
});
// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Route::get('/', [CustomerController::class, 'index'])->name('customerDashboard');
    // Route::get('/products', [CustomerController::class, 'viewProducts'])->name('customer.products');
    // Route::post('/order', [CustomerController::class, 'placeOrder'])->name('customer.order');
});
// Route::get('/home', [CustomerController::class, 'index'])->name('customerDashboard');
require __DIR__.'/auth.php';