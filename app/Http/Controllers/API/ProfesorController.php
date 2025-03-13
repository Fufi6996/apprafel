<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
       try {
           $request->validate([
               'nom_prof' => 'required|string|max:100',
               'email_prof' => 'required|email|unique:profesores,email_prof',
           ]);

           $profesor = Profesor::create($request->all());
           return response()->json($profesor, 201);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al crear el profesor'], 500);
       }
   }

   // GET /api/profesores/{id} (Mostrar uno)
   public function show($id)
   {
       try {
           $profesor = Profesor::with('asignaturas')->findOrFail($id);
           return response()->json($profesor);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Profesor no encontrado'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al mostrar el profesor'], 500);
       }
   }

   // PUT /api/profesores/{id} (Actualizar)
   public function update(Request $request, $id)
   {
       try {
           $profesor = Profesor::findOrFail($id);

           $request->validate([
               'nom_prof' => 'sometimes|string|max:100',
               'email_prof' => 'sometimes|email|unique:profesores,email_prof,' . $profesor->id,
           ]);

           $profesor->update($request->all());
           return response()->json($profesor);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Profesor no encontrado'], 404);
       } catch (ValidationException $e) {
           return response()->json(['error' => $e->errors()], 422);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al actualizar el profesor'], 500);
       }
   }

   // DELETE /api/profesores/{id} (Eliminar)
   public function destroy($id)
   {
       try {
           $profesor = Profesor::findOrFail($id);
           $profesor->delete();
           return response()->json(null, 204);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'Profesor no encontrado'], 404);
       } catch (\Exception $e) {
           return response()->json(['error' => 'Error al eliminar el profesor'], 500);
       }
   }
}
