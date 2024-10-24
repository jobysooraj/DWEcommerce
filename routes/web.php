<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PermissionController;

use App\Http\Controllers\Customer\CustomerController as CustomerHome;

use App\Http\Controllers\Vendors\VendorController as VendorDealers;
use App\Http\Controllers\Vendors\ProductController as VendorProduct;
use App\Http\Controllers\Vendors\StockController as VendorStock;
use App\Http\Controllers\Vendors\CategoryController as VendorCategory;
use App\Http\Controllers\CartController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route::resource('admin/product', ProductController::class);
    Route::get('admin/product/index', [ProductController::class,'index'])->name('product.index');
    Route::get('admin/product/create', [ProductController::class,'create'])->name('product.create');
    Route::get('admin/product/{id}/edit', [ProductController::class,'edit'])->name('product.edit');
    Route::put('admin/product/update/{id}', [ProductController::class,'update'])->name('product.update');
    Route::post('admin/product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('/admin/product/show/{id}', [ProductController::class, 'show'])->name('product.show'); // Note the {id} parameter
    Route::delete('admin/product/delete/{id}', [ProductController::class,'destroy'])->name('product.destroy');

    // Vendor management
    Route::resource('admin/vendors', VendorController::class);
    Route::get('admin/vendor/index', [VendorController::class,'index'])->name('vendor.index');
    Route::get('admin/vendor/create', [VendorController::class,'create'])->name('vendor.create');
    Route::post('admin/vendor/store', [VendorController::class,'store'])->name('vendor.store');
    Route::get('admin/vendor/show/{id}', [VendorController::class,'show'])->name('vendor.show');
    Route::get('admin/vendor/{id}/edit', [VendorController::class,'edit'])->name('vendor.edit');
    Route::put('admin/vendor/update/{vendor}', [VendorController::class,'update'])->name('vendor.update');
    Route::delete('admin/vendor/delete/{id}', [VendorController::class,'destroy'])->name('vendor.destroy');


    
    // Route::resource('admin/stock', VendorController::class);

     
     Route::get('admin/stock/index', [StockController::class,'index'])->name('stock.index');
     Route::get('admin/stock/create', [StockController::class,'create'])->name('stock.create');
     Route::post('admin/stock/store', [StockController::class,'store'])->name('stock.store');
     Route::get('admin/stock/show/{id}', [StockController::class,'show'])->name('stock.show');
     Route::get('admin/stock/{id}/edit', [StockController::class,'edit'])->name('stock.edit');
     Route::put('admin/stock/update/{id}', [StockController::class,'update'])->name('stock.update');
     Route::delete('admin/stock/delete/{id}', [StockController::class,'destroy'])->name('stock.destroy');


     Route::get('admin/customer/index', [CustomerController::class,'index'])->name('customer.index');
     Route::get('admin/customer/{id}/edit', [CustomerController::class,'edit'])->name('customer.edit');
     Route::put('admin/customer/update/{id}', [CustomerController::class,'update'])->name('customer.update');
     Route::delete('admin/customer/delete/{id}', [CustomerController::class,'destroy'])->name('customer.destroy');

     Route::get('admin/permission/index', [PermissionController::class,'index'])->name('permission.index');
     Route::get('admin/permission/{id}/edit', [PermissionController::class,'edit'])->name('permission.edit');
     Route::put('admin/permission/update/{id}', [PermissionController::class,'update'])->name('permission.update');
     Route::delete('admin/permission/delete/{id}', [PermissionController::class,'destroy'])->name('permission.destroy');
     Route::get('admin/permission/show/{id}', [PermissionController::class,'show'])->name('permission.show');



});
Route::middleware(['auth','role:vendor'])->group(function () {
    Route::get('/dealer/dashboard', [VendorDealers::class, 'index'])->name('dealer.dashboard');

    Route::get('vendor/product/index', [VendorProduct::class,'index'])->name('vendor.product.index');
    Route::get('vendor/product/create', [VendorProduct::class,'create'])->name('vendor.product.create');
    Route::post('vendor/product/store', [VendorProduct::class,'store'])->name('vendor.product.store');
    Route::get('vendor/product/{id}/edit', [VendorProduct::class,'edit'])->name('vendor.product.edit');
    Route::put('vendor/product/update/{id}', [VendorProduct::class,'update'])->name('vendor.product.update');
    Route::delete('vendor/product/delete/{id}', [VendorProduct::class,'destroy'])->name('vendor.product.destroy');

    // Vendor stock management
    Route::get('vendor/stock/index', [VendorStock::class,'index'])->name('vendor.stock.index');
    Route::get('vendor/stock/create', [VendorStock::class,'create'])->name('vendor.stock.create');
    Route::post('vendor/stock/store', [VendorStock::class,'store'])->name('vendor.stock.store');
    Route::get('vendor/stock/{id}/edit', [VendorStock::class,'edit'])->name('vendor.stock.edit');
    Route::put('vendor/stock/update/{id}', [VendorStock::class,'update'])->name('vendor.stock.update');
    Route::delete('vendor/stock/delete/{id}', [VendorStock::class,'destroy'])->name('vendor.stock.destroy');
    


});
Route::middleware(['auth','role:customer'])->group(function () {
    Route::get('home', [CustomerHome::class,'index'])->name('home.index');
    Route::get('cart', [CartController::class,'index'])->name('cart.index');
    Route::post('add-to-cart', [CartController::class,'store'])->name('cart.store');
    Route::patch('change-cart/{id}', [CartController::class,'update'])->name('cart.update');
    Route::delete('delete-cart-item/{id}', [CartController::class,'destroy'])->name('cart.destroy');


});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
