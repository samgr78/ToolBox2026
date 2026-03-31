<?php

use App\Entity\Cohort\Controllers\CohortController;
use App\Entity\CohortUser\Controllers\CohortUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('cohort')->name('cohort.')
    ->controller(CohortController::class)
    ->group(function () {

        Route::get('/', [CohortController::class, 'index'])->name('index');
        Route::post('/store', [CohortController::class, 'store'])->name('store');
        Route::get('/{cohort}', 'show')->name('show');
        Route::put('/{cohort}', 'update')->name('update');
        Route::delete('/{cohort}', 'destroy')->name('destroy');
        Route::post('/attach-user', [CohortUserController::class, 'store'])->name('cohorts.users.store');

    });
