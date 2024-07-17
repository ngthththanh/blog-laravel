<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post_detail/{id}', [HomeController::class, 'post_detail'])->name('post_detail.post_detail');
Route::get('search_category/{id}', [HomeController::class, 'search_category'])->name('search_category.search_category');
Route::get('post_all', [HomeController::class, 'post_all'])->name('post_all.post_all');