<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('/');
});

Route::prefix('/')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('phonebook.home.index');
    Route::post('/login', [LoginController::class, 'store'])->name('phonebook.home.login');
});

Route::prefix('contact')->middleware('auth')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('phonebook.admin.contact.index');
    Route::post('/search', [ContactController::class, 'search'])->name('phonebook.admin.contact.search');
    Route::post('/store', [ContactController::class, 'store'])->name('phonebook.admin.contact.store');
    Route::patch('/{id}/update', [ContactController::class, 'update'])->name('phonebook.admin.contact.update');
    Route::delete('/{id}/delete', [ContactController::class, 'destroy'])->name('phonebook.admin.contact.destroy');
});
