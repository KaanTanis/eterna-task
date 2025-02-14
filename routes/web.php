<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/{any?}', function () {
    return view('admin');
})->where('any', '.*');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('{username}', [ProductController::class, 'index'])->name('cafe.index');
Route::get('{username}/{category}', [ProductController::class, 'category'])->name('cafe.category');
Route::get('{username}/{category}/{product}', [ProductController::class, 'show'])->name('product.show');

