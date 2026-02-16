<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/web/cohort.php';
require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('auth.login');
});
