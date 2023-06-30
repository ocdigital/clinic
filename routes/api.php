<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register', [App\Http\Controllers\Api\AuthController::class, 'createUser']);
Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'loginUser']);

//Events
Route::get('/events', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/events/{id}', [App\Http\Controllers\EventController::class, 'show']);
Route::post('/events', [App\Http\Controllers\EventController::class, 'store']);
Route::put('/events/{id}', [App\Http\Controllers\EventController::class, 'update']);
Route::delete('/events/{id}', [App\Http\Controllers\EventController::class, 'destroy']);

//Pacientes
Route::get('/pacientes', [App\Http\Controllers\PacienteController::class, 'apiIndex'])->middleware('auth:sanctum');
Route::get('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'apiShow']);
Route::post('/pacientes', [App\Http\Controllers\PacienteController::class, 'store']);
Route::put('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'apiUpdate']);
Route::delete('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'apiUdestroy']);
Route::get('/pacientes/search/{nome}', [App\Http\Controllers\PacienteController::class, 'apiSearch']);

