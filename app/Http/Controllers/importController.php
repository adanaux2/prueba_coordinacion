<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importUsuarios(Request $request)
    {
        Excel::import(new UsersImport, 'users.xlsx');

        return redirect('/')->with('success', 'All good!');
    }
    public function import()
    {
        return view('formulario');
    }
    public function import2(Request $request)
    {
        //    dd("imp");
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        
    }
}
