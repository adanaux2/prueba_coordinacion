<?php

namespace App\Http\Controllers;

use App\Models\Rvoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rvoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Rvoe::all();
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
        $rvoe = $request->validate([
            // nivel de ingles
            'id_rvoe' => 'required', //required obliga a que este valor no este vacio
            'nombre' => 'required',
        ]);
        $rvoe_licenciatura = $request->validate([
            // nivel de ingles
            'id_rvoe' => 'required', //required obliga a que este valor no este vacio
            'id_licenciatura' => 'required',
        ]);

        DB::table('rvoe')->insert($rvoe);
        DB::table('licenciaturas_rvoe')->insert($rvoe_licenciatura);
        // Retornar una respuesta
        return response()->json(['message' => $rvoe, 'materia' => $request],  201);
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
