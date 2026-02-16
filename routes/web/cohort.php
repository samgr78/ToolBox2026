<?php

use App\entity\cohort\cohortController;
use Illuminate\Support\Facades\Route;

Route::prefix('cohort')->name('cohort.')
    ->controller(CohortController::class)
    ->group(function () {

        Route::get('/', [CohortController::class, 'index'])->name('index');
        Route::post('/store', [CohortController::class, 'store'])->name('store');

    });
