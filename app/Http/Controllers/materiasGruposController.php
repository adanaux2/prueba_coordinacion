<?php

namespace App\Http\Controllers;

use App\Models\MateriasGrupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class materiasGruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return MateriasGrupos::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([


            // nivel de ingles
            'id_materia' => 'required', //required obliga a que este valor no este vacio
            'id_grupo' => 'required',
            'name' => 'required',
            'materia' => 'required',
            'id_profesor' => 'nullable',
            'hora' => 'nullable',


        ]);

        DB::table('materias_grupos')->insert($validatedData);
        // Retornar una respuesta
        return response()->json(['message' => $validatedData, 'guardado' => $request],  201);
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
        return MateriasGrupos::find($id);
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
        $item = MateriasGrupos::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
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
