<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});

// Đăng kí, đăng nhập, đăng xuất.
Auth::routes();

// Xác minh email
Auth::routes(['verify' => true]);

// Quên mật khẩu, gửi mail -> reset mật khẩu.
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Hiện thị ra trang chủ người dùng.
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post_detail/{slug}', [HomeController::class, 'post_detail'])->name('post_detail');
Route::get('search_category/{slug}', [HomeController::class, 'search_category'])->name('search_category');
Route::get('search_tag/{name}', [HomeController::class, 'search_tag'])->name('search_tag');
Route::get('post_all', [HomeController::class, 'post_all'])->name('post_all');
Route::post('search', [HomeController::class, 'search'])->name('search');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/posts/{post}/comments', [HomeController::class, 'addcomment'])->name('comments.addcomment');