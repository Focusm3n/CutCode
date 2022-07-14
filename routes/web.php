<?php

use Illuminate\Support\Facades\Route;

//Route::middleware("r")->group(function (){
//    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
//});

//Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::middleware("auth")->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::post('/posts/comment/{id}', [\App\Http\Controllers\PostController::class, 'comment'])->name('comment');
    Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'showCreatePostForm'])->name('posts.create');
    Route::post('/posts/store', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');

});
Route::middleware("guest")->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
});


