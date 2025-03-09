<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('inicio');
});

require __DIR__.'/services.php';
require __DIR__.'/auth.php';