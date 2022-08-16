<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongeController;

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

Route::get('/conge_valide_api', [CongeController::class, 'congeValideAPI']);
Route::get('/conge_refuse_api', [CongeController::class, 'congeRefuseAPI']);
Route::get('/conge_en_attente_api', [CongeController::class, 'congeEnAttenteAPI']);
Route::get('/conge_non_paye_api/{id?}', [CongeController::class, 'congeNonPayeEmployeAPI']);
