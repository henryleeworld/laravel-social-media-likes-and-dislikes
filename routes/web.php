<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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
Route::redirect('/', 'posts-jquery');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('posts-jquery', [PostController::class, 'jquery'])->name('posts.jquery');
Route::get('posts-vue', [PostController::class, 'vue'])->name('posts.vue');
Route::post('posts/rate', [PostController::class, 'ratePost'])->name('posts.ratePost');
