<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\StoresController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

Route::resource('stores', StoresController::class);
Route::post('/stores', [StoresController::class, 'store'])->name('stores.store');
Route::get('/stores/{store}/edit', [StoresController::class, 'edit'])->name('stores.edit');
Route::put('/stores/{store}/edit', [StoresController::class, 'update'])->name('stores.update');
Route::delete('/stores/{store}', [StoresController::class, 'destroy'])->name('stores.destroy');

Route::resource('books', BooksController::class);
Route::post('/books', [BooksController::class, 'store'])->name('books.store');
Route::get('/books/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}/edit', [BooksController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BooksController::class, 'destroy'])->name('books.destroy');
Route::put('/books/{book}', [BooksController::class, 'update'])->name('books.update');
