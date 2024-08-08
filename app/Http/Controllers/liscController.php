<?php

namespace App\Http\Controllers;

use App\Models\Lisc;
use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class liscController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Lisc::all();
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
        return Lisc::find($id);
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
    public function getLiscMaterias($cuatri, $id_rvoe)
    {
        // Construir la consulta base
        $query = Materias::where('id_rvoe', $id_rvoe);

        // Agregar condiciones adicionales basadas en $cuatri
        switch ($cuatri) {
            case 1:
                // Buscar donde 'name' contenga '101', '102' o '103' al final de su valor 
                $query->where('name', 'regexp', '101$|102$|103$|104$|105$|106$');
                break;
            case 2:
                $query->where('name', 'regexp', '207$|208$|209$|210$|211$|212$');
                break;
            case 3:
                $query->where('name', 'regexp', '313$|314$|315$|316$|317$|318$');
                break;
            case 4:
                $query->where('name', 'regexp', '419$|420$|421$|422$|423$|424$');
                break;
            case 5:
                $query->where('name', 'regexp', '525$|526$|527$|528$|529$|530$');
                break;
            case 6:
                $query->where('name', 'regexp', '631$|632$|633$|634$|635$|636$');
                break;
            case 7:
                $query->where('name', 'regexp', '737$|738$|739$|740$|741$|742$');
                break;
            case 8:
                $query->where('name', 'regexp', '842$|843$|844$|845$|846$|847$|848$');
                break;
            case 9:
                $query->where('name', 'regexp', '946$|947$|948$|949$|950$|951$|952$|953$|954$');
                break;
            case 10:
                $query->where('name', 'regexp', '1050$|1051$|1052$|1053$|1054$|1055$|1056$|1057$|1058$|1059$|1060$');
                break;
            default:
                // Agregar lógica por defecto si es necesario
                // Por ejemplo, podrías retornar todas las materias con el id_rvoe dado
                break;
        }

        // Ejecutar la consulta y retornar los resultados
        return $query->get();
    }
}
