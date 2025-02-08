<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
   // GET /api/aulas (Listar todas)
   public function index()
   {
       $aulas = Aula::with('asignatura')->get();
       return response()->json($aulas);
   }

   // POST /api/aulas (Crear)
   public function store(Request $request)
   {
       $request->validate([
           'nom_aula' => 'required|string|max:50',
           'id_asig' => 'required|exists:asignaturas,id',
       ]);

       $aula = Aula::create($request->all());
       return response()->json($aula, 201);
   }

   // GET /api/aulas/{id} (Mostrar una)
   public function show($id)
   {
       $aula = Aula::with('asignatura')->findOrFail($id);
       return response()->json($aula);
   }

   // PUT /api/aulas/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       $aula = Aula::findOrFail($id);

       $request->validate([
           'nom_aula' => 'sometimes|string|max:50',
           'id_asig' => 'sometimes|exists:asignaturas,id',
       ]);

       $aula->update($request->all());
       return response()->json($aula);
   }

   // DELETE /api/aulas/{id} (Eliminar)
   public function destroy($id)
   {
       $aula = Aula::findOrFail($id);
       $aula->delete();
       return response()->json(null, 204);
   }
}
