<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\TokenController as Token;

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

Auth::routes(['verify' => true]);

Route::prefix('/')->group(function() {
	Route::get('/', [Home::class, 'index'])->name('home.index');
	Route::get('settings', [Home::class, 'settings'])->name('home.settings');
	Route::put('settings', [Home::class, 'saveConfiguration'])->name('home.saveConfiguration');
	Route::delete('vanish', [Home::class, 'vanish'])->name('home.vanish');
});

Route::prefix('token')->group(function() {});
Route::resource('token', Token::class);

Route::prefix('dashboard')->group(function() {
	Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
	Route::get('search', [Dashboard::class, 'search'])->name('dashboard.search');
});