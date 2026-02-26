<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\AlamatController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\RatingController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin (view admin.index)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Admin
    Route::resource('users', UserController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('alamat', AlamatController::class);
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'show', 'destroy']);
    Route::resource('rating', RatingController::class)->only(['index', 'show', 'destroy']);

    // Tambahan khusus transaksi (umum di e-commerce)
    Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])
        ->name('transaksi.updateStatus');

    Route::patch('transaksi/{transaksi}/resi', [TransaksiController::class, 'updateResi'])
        ->name('transaksi.updateResi');
});


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/', function () {
    return view('web.index');
});

Route::get('/', function () {
    return view('web.index');
})->name('home');

Route::get('/about', function () {
    return view('web.about');
})->name('about');

Route::get('/menu', function () {
    return view('web.menu');
})->name('menu');

