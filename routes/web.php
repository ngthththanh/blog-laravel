<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.home');
});

Route::prefix('client')
    ->as('client.')
    ->group(function () {
        Route::get('home/index', [HomeController::class, 'index'])->name('home.index');
    });
