<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class disponibilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return  Disponibilidad::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([


            // nivel de ingles
            'id_profesor' => 'required',//required obliga a que este valor no este vacio
            'id_horario' => 'required',
            

        ]);

        DB::table('disponibilidad')->insert($validatedData);
        // Retornar una respuesta
        return response()->json(['message' => $validatedData, 'xd' => $request],  201);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // Buscar el elemento por id
        $element = Disponibilidad::find($id);

        if ($element) {
            // Eliminar el elemento
            $element->delete();
            return response()->json(['message' => 'Elemento eliminado correctamente.'], 200);
        } else {
            return response()->json(['message' => 'Elemento no encontrado.'], 404);
        }
    
    }
    public function ConsultaP($request){
        // return $request;

        $resultados = Disponibilidad::where('id_profesor', $request)->get();
        $respuesta="No has establecido tu disposicion";

        // Verifica si los resultados están vacíos
        if ($resultados->isEmpty()) {
            return response()->json(['message' => $respuesta], 404); // Código 404 para no encontrado
        } else {
            return response()->json($resultados); // Devuelve los resultados si no están vacíos
        }
        
      
    }
}
