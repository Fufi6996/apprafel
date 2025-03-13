<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
       try {
           $request->validate([
               'nom_asig' => 'required|string|max:100',
               'id_prof' => 'required|exists:profesores,id',
           ]);

           $asignatura = Asignatura::create($request->all());
           return response()->json($asignatura, 201);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al crear la asignatura'], 500);
       }
   }

   // GET /api/asignaturas/{id} (Mostrar una)
   public function show($id)
   {
       try {
           $asignatura = Asignatura::with(['profesor', 'aulas', 'alumnos'])->findOrFail($id);
           return response()->json($asignatura);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Asignatura no encontrada'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al mostrar la asignatura'], 500);
       }
   }

   // PUT /api/asignaturas/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       try {
           $asignatura = Asignatura::findOrFail($id);

           $request->validate([
               'nom_asig' => 'sometimes|string|max:100',
               'id_prof' => 'sometimes|exists:profesores,id',
           ]);

           $asignatura->update($request->all());
           return response()->json($asignatura);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Asignatura no encontrada'], 404);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al actualizar la asignatura'], 500);
       }
   }

   // DELETE /api/asignaturas/{id} (Eliminar)
   public function destroy($id)
   {
       try {
           $asignatura = Asignatura::findOrFail($id);
           $asignatura->delete();
           return response()->json(null, 204);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Asignatura no encontrada'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al eliminar la asignatura'], 500);
       }
   }
}
