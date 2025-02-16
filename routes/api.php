use App\Http\Controllers\API\ProfesorController;
use App\Http\Controllers\API\AsignaturaController;
use App\Http\Controllers\API\AulaController;
use App\Http\Controllers\API\AlumnoController;
use Illuminate\Support\Facades\Route;
Route::apiResource('profesores', ProfesorController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('aulas', AulaController::class);
Route::apiResource('alumnos', AlumnoController::class);
Route::middleware('api')->group(function () {
    Route::apiResource('aulas', aulaController::class);
    Route::apiResource('alumnos', AlumnoController::class);

    // Endpoint per afegir un alumne a una classe
    // Endpoint to retrieve all classes: GET /aulas
    Route::get('aulas', [AulaController::class, 'index']);

    // Endpoint to create a new class: POST /aulas
    Route::post('aulas', [AulaController::class, 'store']);

    // Endpoint to add a student to a class: POST /classes/{classe}/alumnes
    Route::post('aulas/{aula}/alumnos', [aulaController::class, 'addAlumno']);

    // Endpoint per consultar tots els alumnes d'una classe
    // Endpoint to retrieve all students of a class: GET /classes/{classe}/alumnes
    Route::get('aulas/{aula}/alumnos', [aulaController::class, 'getAlumno']);

    // Defineix les rutes de la teva API aquí
    Route::get('/api', function () {
        return response()->json(['message' => 'Hello, API!']);
    });
});
