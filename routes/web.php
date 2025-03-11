<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class,'index'])->name('book.index');
Route::get('/new-book', [BookController::class,'create'])->name('create-book');
Route::post('/new-book', [BookController::class,'store'])->name('store-book');

Route::get('/book/{slug}', [BookController::class,'show'])->name('show-book');

Route::get('/edit-book/{slug}', [BookController::class,'edit'])->name('edit-book');
Route::post('/edit-book/{slug}', [BookController::class,'update'])->name('update-book');
Route::delete('/delete-book/{id}', [BookController::class,'destroy'])->name('delete-book');

Route::get('/sign-up', [UserController::class, 'signupForm'])->name('sign-up-form');
Route::post('/sign-up', [UserController::class,'register'])->name('register');

Route::get('/sign-in', [UserController::class,'signinForm'])->name('sign-in-form');
Route::post('/sign-in', [UserController::class,'login'])->name('login');