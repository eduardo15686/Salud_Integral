<?php

namespace App\Http\Controllers;

use Crypt;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Perfil;
use App\Models\Servicio;

class UsuarioController extends Controller
{
    public function getUsuarios()
    {
        $usuarios = User::with('perfil')
        ->get();
        //$cadenaDesencriptada = Crypt::decryptString($usuarios[0]['password']);
        return $usuarios;
        //return response()->json($usuarios, 200);

    }

    public function nuevoUsuario(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->estatus = 'Activo';
        $user->perfil_id = 2;

        if ($user->save())
            return json_encode(['message' => 'Usuario Agregado Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    public function deleteUsuario(Request $request)
    {
        $usuario = User::find($request['id']);
        $usuario->estatus = 'Inactivo';
        if ($usuario->save())
            return json_encode(['message' => 'Usuario Eliminado Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }


}