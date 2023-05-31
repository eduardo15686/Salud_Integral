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
            ->where('categoria', 'Nivel_1')
            ->get();
        return response()->json($usuarios, 200);
    }

    public function getCategorias($id)
    {
        $usuarios = Servicio::where('estatus', 'Activo')
            ->where('categoria', 'Nivel_2')
            ->where('parent_id', $id)
            ->get();
        return response()->json($usuarios, 200);
    }

    public function getSubCategorias($id)
    {
        $usuarios = Servicio::where('estatus', 'Activo')
            ->where('categoria', 'Nivel_3')
            ->where('parent_id', $id)
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

    public function nuevaCategoria(Request $request)
    {
        $especialista = new Servicio();
        $especialista->parent_id = $request['parent_id'];
        $especialista->text_html = $request['nombre'];
        $especialista->alt_html = $request['nombre'];
        $especialista->categoria = 'Nivel_2';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Categoria Guardada Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    public function nuevaSubCategoria(Request $request)
    {
        $especialista = new Servicio();
        $especialista->parent_id = $request['parent_id'];
        $especialista->text_html = $request['nombre'];
        $especialista->alt_html = $request['nombre'];
        $especialista->categoria = 'Nivel_3';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Categoria Guardada Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

}