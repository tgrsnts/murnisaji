<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
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