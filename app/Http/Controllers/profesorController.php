<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class profesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Profesor::all();
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
        //    Validar los datos del request
        $validatedData = $request->validate([


            // nivel de ingles
            'habla' => 'required',//required obliga a que este valor no este vacio
            'escribe' => 'required',
            'lee' => 'required',


            //grado de estudios

            'licenciatura' => 'required',
            'c_licenciatura' => 'required',
            'maestria' => 'nullable',//nullable permite que el valor pueda ser vacio
            'c_maestria' => 'nullable',
            'doctorado' => 'nullable',
            'c_doctorado' => 'nullable',


            //datos generales

            'nombre_c' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'correo_institucional' => 'required',
            'genero' => 'required',
            'f_nacimiento' => 'required',
            'l_nacimiento' => 'required',
            'rfc' => 'required',
            'curp' => 'required',

            //numeros de contacto

            'nombre_contacto' => 'nullable',
            'relacion_contacto' => 'nullable',
            'telefono_contacto' => 'nullable',
            'nombre_contacto2' => 'nullable',
            'relacion_contacto2' => 'nullable',
            'telefono_contacto2' => 'nullable'

        ]);

        // // Crear el usuario con los datos validados
        // Insertar los datos validados en la base de datos
        // $user = Profesor::create($validatedData);
        DB::table('profesores')->insert($validatedData);
        // Retornar una respuesta
        return response()->json(['message' => $validatedData, 'user' => $request],  201);
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
        return Profesor::find($id);
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
    public function getMaestro($request){
        // return $request;
        $maestros = Profesor::where('curp', $request)->get();
    
        return $maestros[0];
    }
}
