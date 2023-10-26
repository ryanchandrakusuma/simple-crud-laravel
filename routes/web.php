<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StokGudangController;
use App\Http\Controllers\TaxController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'show'])->name('customers.edit');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    //vendors
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::get('/vendors/{id}/edit', [VendorController::class, 'show'])->name('vendors.edit');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
    Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendors.store');
    Route::put('/vendors/{id}', [VendorController::class, 'update'])->name('vendors.update');
    Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendors.destroy');

    //warehouse
    Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
    Route::get('/warehouses/{id}/edit', [WarehouseController::class, 'show'])->name('warehouses.edit');
    Route::get('/warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
    Route::post('/warehouses/store', [WarehouseController::class, 'store'])->name('warehouses.store');
    Route::put('/warehouses/{id}', [WarehouseController::class, 'update'])->name('warehouses.update');
    Route::delete('/warehouses/{id}', [WarehouseController::class, 'destroy'])->name('warehouses.destroy');   
    
    //product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}/edit', [ProductController::class, 'show'])->name('products.edit');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');   
    
    //taxes
    Route::get('/taxes', [TaxController::class, 'index'])->name('taxes.index');
    Route::get('/taxes/{id}/edit', [TaxController::class, 'show'])->name('taxes.edit');
    Route::get('/taxes/create', [TaxController::class, 'create'])->name('taxes.create');
    Route::post('/taxes/store', [TaxController::class, 'store'])->name('taxes.store');
    Route::put('/taxes/{id}', [TaxController::class, 'update'])->name('taxes.update');
    Route::delete('/taxes/{id}', [TaxController::class, 'destroy'])->name('taxes.destroy');  
    
    //stok-gudang
    Route::get('/stok-gudang', [StokGudangController::class, 'index'])->name('stok-gudang.index');
    Route::get('/stok-gudang/{id}/edit', [StokGudangController::class, 'show'])->name('stok-gudang.edit');
    Route::get('/stok-gudang/create', [StokGudangController::class, 'create'])->name('stok-gudang.create');
    Route::post('/stok-gudang/store', [StokGudangController::class, 'store'])->name('stok-gudang.store');
    Route::put('/stok-gudang/{id}', [StokGudangController::class, 'update'])->name('stok-gudang.update');
    Route::delete('/stok-gudang/{id}', [StokGudangController::class, 'destroy'])->name('stok-gudang.destroy');
    Route::get('/stok-gudang/filterByWarehouse', [StokGudangController::class, 'filter']);      

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
