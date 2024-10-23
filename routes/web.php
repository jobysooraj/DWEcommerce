<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

  
    // Vendor management
    Route::resource('admin/vendors', VendorController::class);
    // Product management (for admin)
    Route::get('admin/product/index', [ProductController::class,'index'])->name('product.index');
    Route::get('admin/product/create', [ProductController::class,'create'])->name('product.create');
    Route::post('admin/product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('/admin/product/show/{id}', [ProductController::class, 'show'])->name('product.show'); // Note the {id} parameter

    // Vendor management (for admin)
    // Route::resource('admin/vendors', VendorController::class);
    Route::get('admin/vendor/index', [VendorController::class,'index'])->name('vendor.index');
    Route::get('admin/vendor/create', [VendorController::class,'create'])->name('vendor.create');
    Route::post('admin/vendor/store', [VendorController::class,'store'])->name('vendor.store');
    Route::get('admin/vendor/show/{id}', [VendorController::class,'show'])->name('vendor.show');
     // Route::resource('admin/vendors', VendorController::class);
     Route::get('admin/stock/index', [StockController::class,'index'])->name('stock.index');
     Route::get('admin/stock/create', [StockController::class,'create'])->name('stock.create');
     Route::post('admin/stock/store', [StockController::class,'store'])->name('stock.store');
     Route::get('admin/stock/show/{id}', [StockController::class,'show'])->name('stock.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
