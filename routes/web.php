<?php

use App\Entity\Dashboard\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/web/cohort.php';
require __DIR__.'/auth.php';
require __DIR__.'/web/user.php';
require __DIR__.'/web/teacher.php';
require __DIR__.'/web/student.php';

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/logout', function () {
   auth()->logout();
});
Route::middleware('auth')->get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

