<?php

use Illuminate\Support\Facades\Route;

// ==========================
// ADMIN
// ==========================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\AlamatController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [AdminProdukController::class, 'index'])->name('index');
        Route::get('/create', [AdminProdukController::class, 'create'])->name('create');
        Route::post('/', [AdminProdukController::class, 'store'])->name('store');
        Route::get('/{produk}', [AdminProdukController::class, 'show'])->name('show');
        Route::get('/{produk}/edit', [AdminProdukController::class, 'edit'])->name('edit');
        Route::put('/{produk}', [AdminProdukController::class, 'update'])->name('update');
        Route::delete('/{produk}', [AdminProdukController::class, 'destroy'])->name('destroy');
    });
    
    Route::prefix('alamat')->name('alamat.')->group(function () {
        Route::get('/', [AlamatController::class, 'index'])->name('index');
        Route::get('/create', [AlamatController::class, 'create'])->name('create');
        Route::post('/', [AlamatController::class, 'store'])->name('store');
        Route::get('/{alamat}', [AlamatController::class, 'show'])->name('show');
        Route::get('/{alamat}/edit', [AlamatController::class, 'edit'])->name('edit');
        Route::put('/{alamat}', [AlamatController::class, 'update'])->name('update');
        Route::delete('/{alamat}', [AlamatController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [AdminTransaksiController::class, 'index'])->name('index');
        Route::get('/{transaksi}', [AdminTransaksiController::class, 'show'])->name('show');
        Route::delete('/{transaksi}', [AdminTransaksiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('review')->name('review.')->group(function () {
        Route::get('/', [RatingController::class, 'index'])->name('index');
        Route::get('/{rating}', [RatingController::class, 'show'])->name('show');
        Route::delete('/{rating}', [RatingController::class, 'destroy'])->name('destroy');
    });

    Route::patch(
        'transaksi/{transaksi}/status',
        [AdminTransaksiController::class, 'updateStatus']
    )->name('transaksi.updateStatus');

    Route::patch(
        'transaksi/{transaksi}/resi',
        [AdminTransaksiController::class, 'updateResi']
    )->name('transaksi.updateResi');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});


// ==========================
// WEB (FRONTEND)
// ==========================

use App\Http\Controllers\ProdukController; // frontend produk
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('web.index');
})->name('home');

Route::get('/about', function () {
    return view('web.about');
})->name('about');

Route::get('/menu', [ProdukController::class, 'index'])
    ->name('menu.index');

Route::get('/menu/{produk_id}', [ProdukController::class, 'show'])
    ->name('menu.show');

// --------- cart & checkout ---------
Route::get('/cart', [TransaksiController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add', [TransaksiController::class, 'addToCart'])
    ->name('cart.add');

Route::patch('/cart/item/{produk_id}', [TransaksiController::class, 'updateCartItem'])
    ->name('cart.updateItem');

Route::delete('/cart/item/{produk_id}', [TransaksiController::class, 'removeCartItem'])
    ->name('cart.removeItem');

Route::post('/cart/clear', [TransaksiController::class, 'clearCart'])
    ->name('cart.clear');

// checkout – membuat transaksi
Route::post('/checkout', [TransaksiController::class, 'store'])
    ->name('checkout');

// detail transaksi (frontend)
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])
    ->name('transaksi.show');
