<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RHController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\EntrepriseController;


Route::get('/', function () {
    return view('index_accueil');
})->name('accueil_perso');

// Routes d'authentification laravel ui
Auth::routes();

Route::get('sign-in', function () {
    return view('auth.connexion');
})->name('sign-in');

Route::get('create-compte', [EntrepriseController::class , 'create'])->name('create-compte');

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

Route::get('condition_generale_de_vente', [ConditionController::class, 'index'])->name('condition_generale_de_vente');



// mettre en place un middleware pour les routes non manager : l'appli redirige vers le home par défaut
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['IsManager'])->group(function () {
    Route::get('/home_manager', [ManagerController::class, 'index'])->name('home_manager');
    Route::get('/calendrier_conge', [ManagerController::class, 'calendrier_conge'])->name('calendrier_conge');
});

//-------------------------- Routes pour les congés depuis l'interface RH---------------------------------------------------

Route ::middleware(['IsRH'])->group(function () {
    Route::get('/home_RH', [App\Http\Controllers\RHController::class, 'index'])->name('home_RH');
    Route::get('/rh.calendrier', [RHController::class, 'calendrier'])->name('rh.calendrier');
    // Route::get('/fetchData', [RHController::class, 'fetchData'])->name('fetchData');
    // Route::get('/fetchDataAtt', [RHController::class, 'fetchDataAtt'])->name('fetchDataAtt');

});

//-------------------------- Routes pour les recherches avec filtre de dates ---------------------------------------------------

Route::get('/recherche_conges', [RHController::class, 'filtreDate'])->name('conge.filtre');
// Route::get('/home_RH', [RHController::class, 'filtreDate'])->name('conge.home_RH');

