<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manager\ControllerCalendar;
use App\Http\Controllers\manager\FullCalenderController;
use App\Http\Controllers\employe\CongeEmployeController;
use App\Http\Controllers\employe\modalDemiJourneCongeController;

Route::get('/', function () {
    return view('index_accueil');
})->name('accueil_perso');

Route::get('sign-in', function () {
    return view('auth.connexion');
})->name('sign-in');

Route::get('create-compte', function () {
    return view('create_compte.create_compte');
})->name('create-compte');

Route::get('/info_legale', function () {
    return view('/info_legale');
});
Route::get('contact', function () {
    return view('contact');
});
Route::get('contacts', function () {
    return view('contacts');
});

Route::get('/politique_confidentialite', function () {
    return view('/politique_confidentialite');
})->name('politique_confidentialite');

Route::get('/politique_confidentialites', function () {
    return view('/politique_confidentialites');
});
Route::get('/tarifs', function () {
    return view('/tarif');
});

Route::get('condition_generale_de_vente', 'ConditionController@index')->name('condition_generale_de_vente');

/*--------------------------------------------------------------Controller salohy -----------------------------*/
Route::get('calendar',[ControllerCalendar::class,'index']);
Route::post('test',[ControllerCalendar::class,'test']);

Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('fullcalendar');
Route::get('formHeure', [CongeEmployeController::class, 'indexFormulaireHeure'])->name('formHeure');
Route::get('formJour', [CongeEmployeController::class, 'indexFormulaireJour'])->name('formJour');
Route::get('formDemiJourne', [CongeEmployeController::class, 'indexFormulaireDemiJourne'])->name('formDemiJourne');
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);


Route::get('formConge', [CongeEmployeController::class, 'index'])->name('formConge');
Route::get('test-modal', [CongeEmployeController::class, 'index2'])->name('test-modal');
Route::post('modalDemiJourne', [modalDemiJourneCongeController::class, 'stockValueSession'])->name('modalDemiJourne');

Route::post('insererConge', [CongeEmployeController::class, 'insertionConge'])->name('insererConge');

Route::get('testCalendar',[FullCalenderController::class,'indexTest'])->name('testCalendar');
Route::post('insert_absence',[FullCalenderController::class,'insertConge'])->name('insert_absence');

