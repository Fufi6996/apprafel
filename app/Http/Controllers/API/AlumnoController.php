<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // GET /api/alumnos (Listar todos)
    public function index()
    {
        $alumnos = Alumno::with('asignatura')->get();
        return response()->json($alumnos);
    }

    // POST /api/alumnos (Crear)
    public function store(Request $request)
    {
        $request->validate([
            'nom_alu' => 'required|string|max:100',
            'llinatges' => 'required|string|max:100',
            'mail' => 'required|email',
            'dni' => 'required|string|unique:alumnos,dni|max:9',
            'fecha_nac' => 'required|date',
            'id_asig' => 'required|exists:asignaturas,id',
        ]);

        $alumno = Alumno::create($request->all());
        return response()->json($alumno, 201);
    }

    // GET /api/alumnos/{id} (Mostrar uno)
    public function show($id)
    {
        $alumno = Alumno::with('asignatura')->findOrFail($id);
        return response()->json($alumno);
    }

    // PUT /api/alumnos/{id} (Actualizar)
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $request->validate([
            'nom_alu' => 'sometimes|string|max:100',
            'llinatges' => 'sometimes|string|max:100',
            'mail' => 'sometimes|email',
            'dni' => 'sometimes|string|unique:alumnos,dni,' . $alumno->id . '|max:9',
            'fecha_nac' => 'sometimes|date',
            'id_asig' => 'sometimes|exists:asignaturas,id',
        ]);

        $alumno->update($request->all());
        return response()->json($alumno);
    }

    // DELETE /api/alumnos/{id} (Eliminar)
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return response()->json(null, 204);
    }
}
