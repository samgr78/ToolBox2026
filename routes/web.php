<?php

use App\Entity\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\ProfileController;


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



// gerer le compte

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile/information', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.email.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
