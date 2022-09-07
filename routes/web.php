<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
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

Route::prefix('/')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('phonebook.home.index');
    Route::post('/login', [LoginController::class, 'login'])->name('phonebook.home.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('phonebook.admin.logout');
});

Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('phonebook.admin.contact.index');
});
