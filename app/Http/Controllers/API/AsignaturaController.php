<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
   // GET /api/asignaturas (Listar todas)
   public function index()
   {
       $asignaturas = Asignatura::with(['profesor', 'aulas', 'alumnos'])->get();
       return response()->json($asignaturas);
   }

   // POST /api/asignaturas (Crear)
   public function store(Request $request)
   {
       $request->validate([
           'nom_asig' => 'required|string|max:100',
           'id_prof' => 'required|exists:profesores,id',
       ]);

       $asignatura = Asignatura::create($request->all());
       return response()->json($asignatura, 201);
   }

   // GET /api/asignaturas/{id} (Mostrar una)
   public function show($id)
   {
       $asignatura = Asignatura::with(['profesor', 'aulas', 'alumnos'])->findOrFail($id);
       return response()->json($asignatura);
   }

   // PUT /api/asignaturas/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       $asignatura = Asignatura::findOrFail($id);

       $request->validate([
           'nom_asig' => 'sometimes|string|max:100',
           'id_prof' => 'sometimes|exists:profesores,id',
       ]);

       $asignatura->update($request->all());
       return response()->json($asignatura);
   }

   // DELETE /api/asignaturas/{id} (Eliminar)
   public function destroy($id)
   {
       $asignatura = Asignatura::findOrFail($id);
       $asignatura->delete();
       return response()->json(null, 204);
   }
}
