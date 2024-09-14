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
    public function index()
    {
        //
        try {
            // Obtener los parámetros de paginación de la solicitud
            $page = $request->query('page', 1); // Número de página, predeterminado es 1
            $perPage = $request->query('perPage', 10); // Cantidad de elementos por página, predeterminado es 10
    
            // Calcular el índice de inicio para la consulta
            $startIndex = ($page - 1) * $perPage;
    
            // Obtener los registros paginados, 
            // Ordenados por fecha de creación de forma descendente
            $Users = Delivery::offset($startIndex)->limit($perPage)->get();

    
            // Retornar una respuesta con las ofertas de empleo paginadas
            return response()->json(['data' => $Users], 200);
        } catch (\Exception $e) {
            // Loguear el error
            Log::error('Error al obtener los registros: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los registros. '], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Crea una nueva oferta de trabajo
            $Delivery = new Delivery();
            $Delivery->title = $request->title;
            $Delivery->location = $request->location;
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
