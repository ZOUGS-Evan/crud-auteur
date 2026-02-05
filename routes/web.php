<?php

use App\Http\Controllers\auteurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('auteurs', auteurController::class);

Route::get('/auteurs/export/csv', [auteurController::class, 'exportCsv'])
    ->name('auteurs.export.csv');


Route::get('/auteurs/import/form', [auteurController::class, 'importCsvForm'])
    ->name('auteurs.import.form');

Route::post('/auteurs/import/csv', [auteurController::class, 'importCsv'])
    ->name('auteurs.import.csv');

Route::post('/auteurs/import/confirm', [auteurController::class, 'confirmImport'])
    ->name('auteurs.import.confirm');
