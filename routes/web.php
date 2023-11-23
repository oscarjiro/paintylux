<?php

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

Route::view('/', 'index')
    ->name('index');

Route::view('/produk', 'products.index')
    ->name('products');

Route::view('/proyek', 'projects.index')
    ->name('projects');

Route::view('/kontak', 'contact')
    ->name('contact');

Route::view('/checkout', 'checkout')
    ->name('checkout');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

require __DIR__ . '/auth.php';
