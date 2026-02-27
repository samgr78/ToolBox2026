<?php

use App\Entity\User\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('teacher')->name('teacher.')
    ->controller(teacherController::class)
    ->group(function () {
        Route::get('/', [teacherController::class, 'index'])->name('index');
    });
