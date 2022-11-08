<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Создаем свой роут
Route::get('/books', [\App\Http\Controllers\BookController::class, 'index'])->name('books');
Route::get('/books/create', [\App\Http\Controllers\BookController::class, 'create'])->name('books.create');
Route::get('/books/edit/{id}', [\App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
Route::post('/books/add', [\App\Http\Controllers\BookController::class, 'add'])->name('books.add');
Route::post('/books/save/{id}', [\App\Http\Controllers\BookController::class, 'save'])->name('books.save');
Route::get('/books/delete/{id}', [\App\Http\Controllers\BookController::class, 'delere'])->name('books.delete');
