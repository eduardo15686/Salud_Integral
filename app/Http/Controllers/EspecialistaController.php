<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function guardarEspecialista(Request $request)
    {
        $especialista = new Especialista();
        $especialista->user_id = Auth::user()->id;
        $especialista->nombre = $request['nombre'];
        $especialista->apellido_pat = $request['paterno'];
        $especialista->apellido_mat = $request['materno'];
        $especialista->titulo = $request['titulo'];
        $especialista->celular = $request['celular'];
        $especialista->correo = $request['correo'];
        $especialista->deposito = $request['deposito'];
        $especialista->id_servicio = '1,2,3,4,5';
        $especialista->descripcion = $request['descripcion'];
        $especialista->slug = '';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Datod Guardados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getInfoEspecialista()
    {
        $especialistaInfo = Especialista::where('user_id', Auth::user()->id)->where('estatus', 'Activo')->first();
        return response()->json($especialistaInfo, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialista $especialista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialista $especialista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialista $especialista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialista $especialista)
    {
        //
    }

    public function genSlug()
    {

        //$slug = rand(1,999999999);
        //$result = hash("sha256", $slug);
        $result = random_bytes(16);
        $slug = bin2hex($result);


        $validator = \Validator::make(['slug' => $slug], ['slug' => 'unique:clientes,slug']);

        if ($validator->fails()) {
            $this->genSlug();
        }

        return $slug;
    }
}