<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class sessionsController extends Controller
{
    //
    public function create(){

        return view('auth.login');
    }

    public function store(){

        if(auth()->attempt(request(['name','password'])) == false){
            return back()->withErrors([
                'message' => 'correo o contraseña incorrectas',
        ]);
        }
        $rol = auth()->user()->id_rol;
        // return $rol;

        if ($rol=='1') {
            # code...
            return redirect()->to('admin');
        } else {
            # code...
            if ($rol =='2') {
                # code...
                return redirect()->to('coordinacion');
            } else {
                # code...
                if ($rol=='3') {
                    # code...
                    return redirect()->to('maestros');
                } else {
                    # code...
                }
                
            }
            
        }
        

        return redirect()->to('/');
    }
    public function destroy(){
        auth()->logout();

        return redirect()->to('login');
    }
}
