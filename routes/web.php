<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;
use resources\views\UEs\create;
use App\Http\Controllers\EtudiantsController;
use App\Http\Controllers\NotesController;


Route::get('/', function () {
    return view('interface/interface');
});

Route::get('/ues/create', [UEsController::class, 'create'])->name('UEs.create');
Route::post('/ues/store', [UEsController::class, 'store'])->name('UEs.store');
Route::get('/ues', [UEsController::class, 'index'])->name('UEs.index');
Route::get('/ues/{id}/edit', [UEsController::class, 'edit'])->name('UEs.edit');
Route::put('/ues/{id}', [UEsController::class, 'update'])->name('UEs.update');
Route::delete('/ues/{id}', [UEsController::class, 'destroy'])->name('UEs.destroy');


Route::get('/ecs/create', [ECsController::class, 'create'])->name('ECs.create');
Route::post('/ecs/store', [ECsController::class, 'index'])->name('ECs.store');
Route::get('/ecs', [ECsController::class, 'index'])->name('ECs.index');

Route::get('/ecs/{id}/edit', [ECsController::class, 'edit'])->name('ECs.edit');
Route::put('/ecs/{id}/update', [ECsController::class, 'update'])->name('ECs.update');
Route::delete('/ecs/{id}/destroy', [ECsController::class, 'destroy'])->name('ECs.destroy');




Route::get('/notes/create', [NotesController::class, 'create'])->name('Notes.create');
Route::post('/notes/store', [NotesController::class, 'store'])->name('Notes.store');
Route::get('/notes', [NotesController::class, 'index'])->name('Notes.index');
Route::get('/notes/{id}/edit', [NotesController::class, 'edit'])->name('Notes.edit');
Route::put('/notes/{id}', [NotesController::class, 'update'])->name('Notes.update');
Route::delete('/notes/{id}', [NotesController::class, 'destroy'])->name('Notes.destroy');




Route::get('/etudiants/create', [EtudiantsController::class, 'create'])->name('Etudiants.create');
Route::post('/etudiants/store', [EtudiantsController::class, 'store'])->name('Etudiants.store');
Route::get('/etudiants',        [EtudiantsController::class, 'index'])->name('Etudiants.index');
Route::get('/etudiants/{id}/edit', [EtudiantsController::class, 'edit'])->name('Etudiants.edit');
Route::put('/etudiants/{id}',      [EtudiantsController::class, 'update'])->name('Etudiants.update');
Route::delete('/etudiants/{id}',   [EtudiantsController::class, 'destroy'])->name('Etudiants.destroy');



Route::get('/resultats/create', [ResultatsController::class, 'create'])->name('Resultats.create');
Route::post('/resultats/store', [ResultatsController::class, 'store'])->name('Resultats.store');
Route::get('/resultats', [ResultatsController::class, 'index'])->name('Resultats.index');
Route::get('/resultats/{id}/edit', [ResultatsController::class, 'edit'])->name('Resultats.edit');
Route::put('/resultats/{id}', [ResultatsController::class, 'update'])->name('Resultats.update');
Route::delete('/resultats/{id}', [ResultatsController::class, 'destroy'])->name('Resultats.destroy');


