<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialista;
use App\Models\Foto;
use App\Models\Prospecto;
use App\Models\Agenda;


use Carbon\Carbon;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function getEspecialistas(Request $request)
    {
        $fecha = $request['fecha'];

        $especialistas = Especialista::with('foto')
            ->with([
                'horario_mañana' => function ($query) use ($fecha) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                    $query->whereDate('fecha', $fecha);
                },
                'horario_tarde' => function ($query) use ($fecha) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                    $query->whereDate('fecha', $fecha);
                }

            ])
            ->withCount([
                'horario_tarde as contador' => function ($query) use ($fecha) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                    $query->whereDate('fecha', $fecha);
                }
            ])
            ->where('estatus', 'Activo')
            ->get();

        $array_permisos = explode(',', $especialistas[0]['servicio_id']);

        

        return response()->json($especialistas, 200);

    }
    public function agendarCita(Request $request)
    {
        // $servicio_id = implode(', ', $request['registro']);
        // $prospecto->especialista_id = $request['especialista'];
        // $prospecto->servicios_id = $servicio_id;
        $prospecto = new Prospecto();
        $prospecto->nombre = $request['nombre'];
        $prospecto->correo = $request['correo'];
        $prospecto->celular = $request['celular'];
        $prospecto->edad = $request['edad'];
        $prospecto->primera_vez = $request['primera_vez'];
        $prospecto->sexo = $request['sexo'];
        $prospecto->modalidad = $request['modalidad'];
        $prospecto->proceso = 'Enviada';
        $prospecto->estatus = 'Activo';
        $prospecto->save();


        $agendar = Agenda::find($request['hora_cita']);
        $agendar->prospecto_id = $prospecto['id'];
        $agendar->proceso = 'Apartada';
        $agendar->save();

        return response()->json($agendar, 200);

    }
    public function obtenerLinkFoto()
    {
        $imagenPerfil = Foto::where('user_id', 1)
            ->orderBy('id', 'desc')
            ->first();
        return asset('img/fotos/' . $imagenPerfil['imagen_path']);
    }

    public function obtenerHorario()
    {
        $especialistas = Especialista::with('foto')
            ->with([
                'horario_mañana' => function ($query) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                }
            ])
            ->where('estatus', 'Activo')
            ->get();

        return response()->json($especialistas, 200);
    }
}