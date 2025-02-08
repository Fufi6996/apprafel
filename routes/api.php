use App\Http\Controllers\API\ProfesorController;
use App\Http\Controllers\API\AsignaturaController;
use App\Http\Controllers\API\AulaController;
use App\Http\Controllers\API\AlumnoController;

Route::apiResource('profesores', ProfesorController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('aulas', AulaController::class);
Route::apiResource('alumnos', AlumnoController::class);
