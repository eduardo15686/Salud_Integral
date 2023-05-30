<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function getPerfiles()
    {
        $perfiles = Perfil::all()->where('estatus', 'Activo');

        return response()->json($perfiles, 200);
    }

    public function SavePerfil(Request $request)
    {
        $perfil = new Perfil();
        $perfil->nombre_perfil = $request['nombre_perfil'];
        $perfil->permisos_id = '1,' . $request['permisos_id'];
        $perfil->slug = 321354321;
        $perfil->estatus = 'Activo';
        $perfil->created_by = Auth::user()->id;
        $perfil->updated_by = Auth::user()->id;
        if ($perfil->save())
            return json_encode(['message' => 'Perfil guardado correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    public function UpdatePerfil(Request $request)
    {

        Perfil::where('id', $request['id'])->update([
            'nombre_perfil' => $request['nombre_perfil'],
            'permisos_id' => '1,' . $request['permisosReal']
        ]);
    }

    public function DeletePerfil(Request $request)
    {
        $perfil = Perfil::find($request['id']);
        $perfil->estatus = 'Inactivo';
        if ($perfil->save())
            return json_encode(['message' => 'Perfil Eliminado Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }
}