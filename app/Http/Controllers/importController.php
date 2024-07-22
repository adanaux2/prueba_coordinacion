<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importUsuarios(Request $request)
    {
        // Excel::import(new UsersImport, 'users.xlsx');

        // return redirect('/')->with('success', 'All good!');
    }
    public function import()
    {
        return view('formulario');
    }
    public function import2(Request $request)
    {
        //    dd("imp");
         // Validar el request
         $request->validate([
            'file' => 'required|file',
            'id_rvoe' => 'required|string',
        ]);
         // Obtener el archivo y el id_rvoe
         $file = $request->file('file');
         $id_rvoe = $request->input('id_rvoe');
 
         // Procesar la importación del archivo y pasar el id_rvoe
         Excel::import(new UsersImport($id_rvoe), $file);
 
 
         // Realizar cualquier acción adicional con el id_rvoe
         // Por ejemplo, podrías guardar el id_rvoe en la base de datos, asociarlo con los usuarios importados, etc.
 
         // Devolver una respuesta
         return response()->json(['message' => 'Usuarios importados exitosamente', 'id_rvoe' => $id_rvoe]);
 

        // $file = $request->file('file');
        // Excel::import(new UsersImport, $file);
        
    }
}
