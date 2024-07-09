<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.home');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('post/{id}', [PostDetailController::class, 'index'])->name('post_detail.index');