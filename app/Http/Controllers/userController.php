<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = DB::table('users')
        // ->select('id', 'id_rol', 'name', 'email', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at"), 'updated_at')
        // ->get();

        // return $users;
        // return User::all();
        $users = DB::table('users')
            ->join('roles', 'users.id_rol', '=', 'roles.id_rol') // Unir la tabla roles
            ->select('users.id', 'users.id_rol', 'users.name', 'users.email', DB::raw("DATE_FORMAT(users.created_at, '%Y-%m-%d') as created_at"), 'users.updated_at', 'roles.rol as nombre_rol') // Seleccionar los campos de users y roles
            ->get();

        return $users;
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
        return User::find($id);
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
        $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->id_rol = $request->get('rol');
        // $user->password = $request->get('pass');
        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('pass')) {
            $user->password = $request->input('pass');
        }

        $user->update();
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
        $user = User::find($id);
        $user->delete();
    }
}
