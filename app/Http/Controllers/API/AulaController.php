<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
       try {
           $request->validate([
               'nom_aula' => 'required|string|max:50',
               'id_asig' => 'required|exists:asignaturas,id',
           ]);

           $aula = Aula::create($request->all());
           return response()->json($aula, 201);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al crear el aula'], 500);
       }
   }

   // GET /api/aulas/{id} (Mostrar una)
   public function show($id)
   {
       try {
           $aula = Aula::with('asignatura')->findOrFail($id);
           return response()->json($aula);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Aula no encontrada'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al mostrar el aula'], 500);
       }
   }

   // PUT /api/aulas/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       try {
           $aula = Aula::findOrFail($id);

           $request->validate([
               'nom_aula' => 'sometimes|string|max:50',
               'id_asig' => 'sometimes|exists:asignaturas,id',
           ]);

           $aula->update($request->all());
           return response()->json($aula);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Aula no encontrada'], 404);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al actualizar el aula'], 500);
       }
   }

   // DELETE /api/aulas/{id} (Eliminar)
   public function destroy($id)
   {
       try {
           $aula = Aula::findOrFail($id);
           $aula->delete();
           return response()->json(null, 204);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Aula no encontrada'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al eliminar el aula'], 500);
       }
   }
}
