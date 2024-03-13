<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class registerController extends Controller
{
    //
    public function create(){

        return view('auth.register');
    }
    
    public function store(){

        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            // return response(json(request()));
        ]);

        $user = User::create(request(['name','email','password']));
         
        auth()->login($user);
        return redirect()->to('/');


    }
    public function store2(Request $request){//esta funcion es utilizada por los administradores para crear nuevos usuarios
        // Validar los datos del request
    $validatedData = $request->validate([
        
        'name' => 'required',
        'email' => 'required|email|unique:users', // Asegúrate de que el email sea único
        'password' => 'required|min:4', // Asume que la contraseña debe tener al menos 4 caracteres
        'id_rol' => 'required',
    ]);

    // Crear el usuario con los datos validados
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' =>$validatedData['password'], // Encriptar la contraseña antes de guardarla
        'id_rol' => $validatedData['id_rol'],
    ]);
    // Retornar una respuesta
    return response()->json(['message' => 'User created successfully', 'user' => $user],  201);
    }
}
