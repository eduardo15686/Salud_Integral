<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{

    public function getServicios()
    {
        $usuarios = Servicio::where('estatus', 'Activo')
            ->get();
        return response()->json($usuarios, 200);

    }
    public function nuevoServicio(Request $request)
    {
        $especialista = new Servicio();
        $especialista->parent_id = 0;
        $especialista->text_html = $request['nombre'];
        $especialista->alt_html = $request['nombre'];
        $especialista->categoria = 'Nivel_1';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Servicio Guardado Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

}