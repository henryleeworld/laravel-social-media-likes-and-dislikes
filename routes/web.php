<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts-jquery');
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('posts-jquery', [PostController::class, 'jquery'])->name('posts.jquery');
Route::get('posts-vue', [PostController::class, 'vue'])->name('posts.vue');
Route::post('posts/rate', [PostController::class, 'ratePost'])->name('posts.ratePost');
