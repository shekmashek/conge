<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CongeApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/conge_valide_api', [CongeApiController::class, 'congeValideAPI']);
Route::get('/conge_refuse_api', [CongeApiController::class, 'congeRefuseAPI']);
Route::get('/conge_en_attente_api', [CongeApiController::class, 'congeEnAttenteAPI']);

// retourne les congés payé/non payé validé de tous ou d'un employé donné
Route::get('/conge_non_paye_api/{id?}', [CongeApiController::class, 'congeNonPayeEmployeAPI']);
Route::get('/conge_paye_api/{id?}', [CongeApiController::class, 'congePayeEmployeAPI']);

// retourne les congés validés d'un employé groupé par type de congé
Route::get('/types_conge_employe_api/{id}', [CongeApiController::class, 'typesCongesEmployeApi']);
