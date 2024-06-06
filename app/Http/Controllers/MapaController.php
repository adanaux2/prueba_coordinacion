<?php

namespace App\Http\Controllers;

use App\Models\MapaCurricular;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return MapaCurricular::all();
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
        $materias = $request->input('materias');

        // Validar la solicitud si es necesario
        $validated = $request->validate([
            
            'materias.*.id_profe' => 'required|integer',
            'materias.*.id_materia' => 'required|integer'
        ]);

        foreach ($materias as $materia) {
            MapaCurricular::create([
                // 'name' => $materia['name'],
                'id_materia' => $materia['id_materia'],
                'id_profe' => $materia['id_profe'],
                // Agregar otros campos según sea necesario
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Materias guardadas exitosamente.']);
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
    }
}
