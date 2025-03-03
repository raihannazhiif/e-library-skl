<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class,'index'])->name('book.index');
Route::get('/new-book', [BookController::class,'create'])->name('create-book');
Route::post('/new-book', [BookController::class,'store'])->name('store-book');