<?php

use App\entity\user\Teacher\TeacherController;
use App\entity\user\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('teacher')->name('teacher.')
    ->controller(teacherController::class)
    ->group(function () {
        Route::get('/', [teacherController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });
