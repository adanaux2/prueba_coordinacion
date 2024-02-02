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
}
