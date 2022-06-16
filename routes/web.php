<?php

use Illuminate\Support\Facades\Route;

//Route::middleware("r")->group(function (){
//    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
//});

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
