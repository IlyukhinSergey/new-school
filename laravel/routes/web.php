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

// 'middleware' => 'auth'
//Создаем свой роут
Route::group(['prefix' => 'books'], function (){
    Route::get('/', [\App\Http\Controllers\BookController::class, 'index'])->name('books');
    Route::get('create', [\App\Http\Controllers\BookController::class, 'create'])->name('books.create');
    Route::get('edit/{id}', [\App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
    Route::post('add', [\App\Http\Controllers\BookController::class, 'add'])->name('books.add');
    Route::post('save/{id}', [\App\Http\Controllers\BookController::class, 'save'])->name('books.save');
    Route::get('delete/{id}', [\App\Http\Controllers\BookController::class, 'delete'])->name('books.delete');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
