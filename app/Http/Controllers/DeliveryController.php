<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            
            // Obtener el usuario autenticado
            $user = $request->user();

            // Obtener los parámetros de paginación de la solicitud
            $perPage = $request->query('perPage', 10); // Cantidad de elementos por página, predeterminado es 10

            // Construir la consulta base
            $query = Delivery::query();

            // Si el usuario tiene 'type' 2, filtrar por 'id_user'
            if ($user->type == 2) {
                $query->where('id_user', $user->id);
            }

            // Obtener los registros paginados
            $deliveries = $query->paginate($perPage);

            // Retornar la respuesta paginada
            return response()->json($deliveries, 200);

        } catch (\Exception $e) {
            // Loguear el error
            Log::error('Error al obtener los registros: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los registros. '], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Obtener el usuario autenticado
            $user = $request->user();

            // Crea una nueva oferta de trabajo
            $Delivery = new Delivery();
            $Delivery->title = $request->title;
            $Delivery->location = $request->location;
            $Delivery->id_user = $user->id;
            $Delivery->save();

            // Retorna una respuesta de éxito
            return response()->json(['message' => 'Registro creado con éxito', 'data' => $Delivery], 201);
        } catch (\Exception $e) {
            // Loguea el error
            Log::error('Error al guardar el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar el registro', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
        try {
            $Delivery = Delivery::findOrFail($id);
            $Delivery->update($request->all());

            return response()->json(['message' => 'Registro actualizado con éxito', 'data' => $Delivery], 200);
        } catch (\Exception $e) {
            Log::error('Error al actualizar registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar registro'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $Delivery = Delivery::findOrFail($id);
            $Delivery->delete();

            return response()->json(['message' => 'Registro eliminado con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error al eliminar registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar registro '], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
