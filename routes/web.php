<?php

use App\entity\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

require __DIR__.'/web/cohort.php';
require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('auth.login');
});
Route::get('/logout', function () {
   auth()->logout();
});
Route::middleware('auth')->get('/dashboard',[DashboardController::class, 'index'])->name('index');
