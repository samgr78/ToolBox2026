<?php

use App\entity\cohort\CohortController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('cohort')->name('cohort.')
    ->controller(CohortController::class)
    ->group(function () {

        Route::get('/', [CohortController::class, 'index'])->name('index');
        Route::post('/store', [CohortController::class, 'store'])->name('store');

    });
