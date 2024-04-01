<?php

use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\EscuelaController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('escuelas', [EscuelaController::class, 'indexAll']);
    Route::resource('escuela', EscuelaController::class)->except(['edit', 'create']);
    Route::resource('alumno', AlumnoController::class)->except(['edit', 'create']);
});
