<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostAllController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.home');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('post_detail/{id}', [PostDetailController::class, 'index'])->name('post_detail.index');
Route::get('search_category/{id}', [SearchController::class, 'index'])->name('search_category.index');
Route::get('search_category_not', [SearchController::class, 'index'])->name('search_category_not.index');
Route::get('post_all', [PostAllController::class, 'index'])->name('post_all.index');
