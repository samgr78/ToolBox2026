<?php

use App\entity\user\Student\StudentController;
use App\entity\user\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('student')->name('student.')
    ->controller(StudentController::class)
    ->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });
