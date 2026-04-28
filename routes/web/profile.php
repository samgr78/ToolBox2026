<?php

use App\Entity\Profile\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
