<?php

use Illuminate\Support\Facades\Route;
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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['IsManager'])->group(function () {
    Route::get('/home_manager', [ManagerController::class, 'index'])->name('home_manager');
});
