<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RHController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ReferentController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\HeureTravailController;
use App\Http\Controllers\RoleController;

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
//-------------------------- admin ---------------------------------------------------

Route::prefix('/admin')->middleware(['IsAdmin'])->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index', ['title' => "admin"]);
    })->name('index');

    Route::get('home', [AdminController::class, 'index'])->name('home');

});
//-------------------------- Manager ---------------------------------------------------
Route::middleware(['IsManager'])->group(function () {
    Route::get('/home_manager', [ManagerController::class, 'index'])->name('home_manager');
    Route::get('/calendrier_conge', [ManagerController::class, 'calendrier_conge'])->name('calendrier_conge');
    Route::get('/listeConge', [ManagerController::class, 'listeConge'])->name('listeConge');
    Route::get('/listeCongeRelative/{id}', [ManagerController::class, 'getRelativeTimeOff'])->name('listeCongeRelative');
    Route::get('/conge_reference/{id}', [ManagerController::class, 'getRejectedTimeOff'])->name('congeReference');
    Route::get('/conge.accepter_demande/{id}', [CongeController::class, 'accepter_demande'])->name('conge.accepter_demande');
    Route::get('/conge.refuser_demande/{id}', [CongeController::class, 'refuser_demande'])->name('conge.refuser_demande');
    Route::get('/employes_manager', [ManagerController::class, 'listeEmployes'])->name('manager.liste_employes');
    Route::get('/stats_conges_manager', [ManagerController::class, 'statisticsConges'])->name('stats_conges_manager');
});

//-------------------------- Routes pour les congés depuis l'interface RH---------------------------------------------------

Route ::middleware(['IsRH'])->group(function () {
    Route::get('/home_RH', [App\Http\Controllers\RHController::class, 'index'])->name('home_RH');
    Route::get('/history_RH', [App\Http\Controllers\RHController::class, 'history_conges'])->name('history_RH');
    Route::get('/liste_en_attente', [App\Http\Controllers\RHController::class, 'liste_en_attente'])->name('liste_en_attente');
    Route::get('/rh.calendrier', [RHController::class, 'calendrier'])->name('rh.calendrier');
    Route::get('employes', [RHController::class, 'employes'])->name('employes');
    Route::get('/liste_employes', [RHController::class, 'liste_employes'])->name('liste_employes');
    Route::get('/employe.edit', [EmployeController::class, 'edit'])->name('employe.edit');
    Route::get('/employe.show', [EmployeController::class, 'show'])->name('employe.show');
    Route::get('/employe.destroy', [EmployeController::class, 'destroy'])->name('employe.destroy');
});

//-------------------------- Routes pour les congés depuis l'interface referent---------------------------------------------------

Route::middleware(['IsReferent'])->group(function () {
    Route::get('/home_referent', [App\Http\Controllers\ReferentController::class, 'index'])->name('home_referent');
    Route::get('/edit_work_times', [HeureTravailController::class, 'edit'])->name('edit_work_times');
    Route::put('/updateTime', [HeureTravailController::class, 'update'])->name('updateTime');
});


// EMPLOYE
Route::middleware(['IsEmploye'])->group(function () {
    Route::controller(CongeController::class)->group(function(){
        Route::get('accueil','accueil')->name('accueil');
        Route::get('conge_employe','homeCongeEmploye')->name('conge_employe');
        Route::post('insert_absence_employe','insertConge')->name('insert_absence_employe');
        Route::get('historique_congeJson', 'historique_congeJson')->name('historique_congeJson');
        Route::get('historique_conge', 'historique_conge')->name('historique_conge');
        Route::get('getListCongesEmpJson', 'getListCongesEmpJson')->name('getListCongesEmpJson');

    });
    Route::controller(CongeController::class)->group(function(){
        /* method: get/post -- url -- method to call in Controller -- name to call in view  */
        Route::get('congeEnAttenteJson', 'congeEnAttenteJson')->name('congeEnAttenteJson');
        Route::get('congeValideJson', 'congeValideJson')->name('congeValideJson');
        Route::get('congeEnAttente', 'congeEnAttente')->name('congeEnAttente');
        Route::get('congeValide', 'congeValide')->name('congeValide');

    });
});

Route::resource('role', RoleController::class);