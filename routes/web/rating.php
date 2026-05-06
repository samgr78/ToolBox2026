<?php

use App\Entity\Rating\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rating/import', [RatingController::class, 'import'])->name('rate.import');
});

