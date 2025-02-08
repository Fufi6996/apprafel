<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
   // GET /api/profesores (Listar todos)
   public function index()
   {
       $profesores = Profesor::with('asignaturas')->get();
       return response()->json($profesores);
   }

   // POST /api/profesores (Crear)
   public function store(Request $request)
   {
       $request->validate([
           'nom_prof' => 'required|string|max:100',
           'email_prof' => 'required|email|unique:profesores,email_prof',
       ]);

       $profesor = Profesor::create($request->all());
       return response()->json($profesor, 201);
   }

   // GET /api/profesores/{id} (Mostrar uno)
   public function show($id)
   {
       $profesor = Profesor::with('asignaturas')->findOrFail($id);
       return response()->json($profesor);
   }

   // PUT /api/profesores/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       $profesor = Profesor::findOrFail($id);

       $request->validate([
           'nom_prof' => 'sometimes|string|max:100',
           'email_prof' => 'sometimes|email|unique:profesores,email_prof,' . $profesor->id,
       ]);

       $profesor->update($request->all());
       return response()->json($profesor);
   }

   // DELETE /api/profesores/{id} (Eliminar)
   public function destroy($id)
   {
       $profesor = Profesor::findOrFail($id);
       $profesor->delete();
       return response()->json(null, 204);
   }
}
