<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
       
        Route::get('/admin/dashboard', [AdminController::class, 'show'])->name('admin.dashboard');
    });

    // Vendor routes
    Route::middleware(['auth', 'role:vendor'])->group(function () {
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
Route::get('/home', [CustomerController::class, 'index'])->name('customerDashboard');
require __DIR__.'/auth.php';