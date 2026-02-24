<?php

use App\entity\user\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('student')->name('student.')
    ->controller(StudentController::class)
    ->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
    });
