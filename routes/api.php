<?php
use App\Http\Controllers\API\ProfesorController;
use App\Http\Controllers\API\AsignaturaController;
use App\Http\Controllers\API\AulaController;
use App\Http\Controllers\API\AlumnoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
Route::apiResource('profesores', ProfesorController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('aulas', AulaController::class);
Route::apiResource('alumnos', AlumnoController::class);


Route::middleware('api')->group(function () {
    // Endpoint to retrieve all aulas: GET /aulas
    Route::get('aulas', [AulaController::class, 'index']);

    // Protegiu les rutes que modifiquen dades amb auth:sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Endpoint per crear una nova aula: POST /aulas
        Route::post('aulas', [AulaController::class, 'store']);

        // Endpoint per afegir un alumno a una aula: POST /aulas/{aula}/alumnos
        Route::post('aulas/{aula}/alumnos', [AulaController::class, 'addalumno']);
    });

    // Endpoint to retrieve all students of a class: GET /aulas/{aula}/alumnos
    Route::get('aulas/{aula}/alumnos', [AulaController::class, 'getalumnos']);
});
