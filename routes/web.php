<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class);
    Route::get('/products/{id}/gallery', [ProductController::class, 'gallery'])
        ->name('products.gallery');

    // Product Galleries
    Route::resource('product-galleries', ProductGalleryController::class);

    // Transactions
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/{id}/set-status', [TransactionController::class, 'setStatus'])->name('transactions.status');
});

