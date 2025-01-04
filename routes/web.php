<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/UEs', [UEsController::class, 'index'])->name('UEs.index');

Route::resource('UEs', UEsController::class);
Route::resource('ECs', ECsController::class);

Route::get('/etudiants/{etudiant}/resultats-par-semestre', [EtudiantController::class, 'afficherResultatsParSemestre'])->name('etudiants.semestre');
Route::get('/etudiants/{etudiant}/stats', [EtudiantController::class, 'showStats'])->name('etudiants.stats');
Route::get('/etudiants/parNiveau/{niveau}', [EtudiantController::class, 'parNiveau']);
Route::resource('etudiants', EtudiantController::class)
    ->except(['destroy', 'show']);

Route::get('/notes/getEcsByUe/{ueId}', [NoteController::class, 'getEcsByUe']);
Route::resource('notes', NoteController::class)
    ->except(['destroy', 'show']);