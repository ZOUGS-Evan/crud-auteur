<?php

use App\Http\Controllers\auteurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('auteurs', auteurController::class);
