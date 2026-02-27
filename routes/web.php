<?php

use App\Entity\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\entity\user\userController;

require __DIR__.'/web/cohort.php';
require __DIR__.'/auth.php';
require __DIR__.'/web/teacher.php';
require __DIR__.'/web/student.php';


Route::get('/', function () {
    return view('auth.login');
});
Route::get('/logout', function () {
   auth()->logout();
});
Route::middleware('auth')->get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

