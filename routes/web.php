<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post_detail/{slug}', [HomeController::class, 'post_detail'])->name('post_detail');
Route::get('search_category/{slug}', [HomeController::class, 'search_category'])->name('search_category');
Route::get('post_all', [HomeController::class, 'post_all'])->name('post_all');
Route::post('search_post', [HomeController::class, 'search_post'])->name('search_post');// routes/web.php

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');