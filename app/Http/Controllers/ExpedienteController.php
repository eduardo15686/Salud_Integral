<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function guardarExpediente(Request $request)
    {
        $expediente = new Expediente;
        $expediente->paciente_id = $request['paciente_id'];
        $expediente->agenda_id = $request['agenda_id'];
        $expediente->fecha = $request['fecha'];
        $expediente->tareas = $request['tareas'];
        $expediente->observaciones = $request['observaciones'];
        $expediente->estatus = 'Activo';
        $expediente->save();
    }

    public function getExpedientes($id)
    {
        $expediente = Expediente::where('paciente_id', $id)
            ->where('estatus', 'Activo')
            ->get();
        return response()->json($expediente, 200);
    }

}