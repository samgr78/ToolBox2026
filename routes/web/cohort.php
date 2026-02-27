<?php

use App\Entity\Cohort\CohortController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('cohort')->name('cohort.')
    ->controller(CohortController::class)
    ->group(function () {

        Route::get('/', [CohortController::class, 'index'])->name('index');
        Route::post('/store', [CohortController::class, 'store'])->name('store');
        Route::get('/{cohort}', 'show')->name('show');
        Route::put('/{cohort}', 'update')->name('update');
        Route::delete('/{cohort}', 'destroy')->name('destroy');

    });
