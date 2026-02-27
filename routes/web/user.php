<?php

use App\entity\user\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user')->name('user.')
    ->controller(userController::class)
    ->group(function () {
        Route::get('/', [userController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });
