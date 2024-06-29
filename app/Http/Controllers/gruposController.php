<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Materias;
use App\Models\MateriasGrupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Grupos::all();
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
            'id_grupo' => 'required', //required obliga a que este valor no este vacio
            'id_licenciatura' => 'required',
            'id_rvoe' => 'required',
            'periodo' => 'required',
            'anio' => 'required',
            'cuatrimestre' => 'required',
            'turno' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',


        ]);

        DB::table('grupos')->insert($validatedData);
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
        return Grupos::find($id);
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
    public function getMaterias($id)
    {
        // return $id;
        // return Materias::where('id',$id);
        return MateriasGrupos::where('id_grupo', $id)->get();
    }
}
