<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Book Routes - Admin Only
Route::middleware(['auth', 'admin'])->name('book.')->prefix('/book')->group(function () {
    Route::get('/', [BookController::class,'index'])->name('index'); // book.index
    Route::get('/new', [BookController::class,'create'])->name('create'); // book.create-book
    Route::post('/new', [BookController::class,'store'])->name('store');
    Route::get('/{slug}', [BookController::class,'show'])->name('show');
    Route::get('/edit/{slug}', [BookController::class,'edit'])->name('edit');
    Route::post('/edit/{slug}', [BookController::class,'update'])->name('update');
    Route::delete('/delete/{id}', [BookController::class,'destroy'])->name('delete');
});

// Dashboard Routes
Route::middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/', function () {
        if (Auth::user()->role == "admin") {
            return view('dashboard.admin.dashboard');
        }
        return view('dashboard.user.dashboard');
    })->name('index');
    // Route::get('/', function () {
    //     return view('dashboard.admin.dashboard');
    // })->name('admin');
});

// Auth Routes
Route::get('/sign-up', [UserController::class, 'signupForm'])->name('sign-up-form');
Route::post('/sign-up', [UserController::class,'register'])->name('register');
Route::get('/sign-in', [UserController::class,'signinForm'])->name('sign-in-form');
Route::post('/sign-in', [UserController::class,'login'])->name('login');
Route::post('/sign-out', [UserController::class,'logout'])->name('logout');