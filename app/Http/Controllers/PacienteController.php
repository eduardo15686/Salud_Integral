<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function guardarPaciente(Request $request)
    {
        $paciente = new Paciente();
        $paciente->especialista_id = Auth::user()->id;
        $paciente->nombre = $request['nombre'];
        $paciente->correo = $request['correo'];
        $paciente->celular = $request['celular'];
        $paciente->edad = $request['edad'];
        $paciente->sexo = $request['sexo'];
        $paciente->estatus = 'Activo';

        if ($paciente->save())
            return json_encode(['message' => 'Datos Guardados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }


    public function getPacientes()
    {
        $paciente = Paciente::where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->get();


        return response()->json($paciente, 200);
    }

}