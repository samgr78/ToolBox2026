<?php

use App\Entity\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user')->name('user.')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::patch('/{user}/update', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });
