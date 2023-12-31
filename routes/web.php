<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::view('proyek', 'projects')
    ->name('projects');

Volt::route('hubungi-kami', 'contact')
    ->name('contact');

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::view('/', 'profile.index')
        ->name('profile');
    Route::view('edit', 'profile.edit')
        ->name('profile.edit');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/admin.php';
