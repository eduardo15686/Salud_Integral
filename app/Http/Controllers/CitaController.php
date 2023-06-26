<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialista;
use App\Models\Foto;
use App\Models\Prospecto;
use App\Models\Agenda;


use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function getEspecialistas(Request $request)
    {
        $fecha = $request['fecha'];
        $infoReal = [];
        $servicios_nombre = [];
        $infoReal = [];
        $guardarInfo = [];
        $especialistas = Especialista::
        // with('foto')->
        with([
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
                'horario_tarde as contador_tarde' => function ($query) use ($fecha) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                    $query->whereDate('fecha', $fecha);
                }
            ])->withCount([
                    'horario_mañana as contador_mañana' => function ($query) use ($fecha) {
                        $query->whereDate('fecha', '>=', Carbon::today());
                        $query->whereDate('fecha', $fecha);
                    }
                ])
            ->where('estatus', 'Activo')
            ->get();

        foreach ($especialistas as $especialista) {

            $servicios_nombre = [];
            $servicios = explode(',', $especialista['servicio_id']);
            foreach ($servicios as $servicio) {
                $servicioInfo = Servicio::where('id', $servicio)
                    ->where('estatus', 'Activo')
                    ->first();
                array_push($servicios_nombre, $servicioInfo['text_html']);

            }
            $infoReal = [
                'especialista' => $especialista,
                'especialidad' => implode(", ", $servicios_nombre)
            ];

            array_push($guardarInfo, $infoReal);
        }
        return response()->json($guardarInfo, 200);

    }
    public function agendarCita(Request $request)
    {
        // $servicio_id = implode(', ', $request['registro']);
        // $prospecto->especialista_id = $request['especialista'];
        // $prospecto->servicios_id = $servicio_id;
        // $prospecto = new Prospecto();
        // $prospecto->nombre = $request['nombre'];
        // $prospecto->correo = $request['correo'];
        // $prospecto->celular = $request['celular'];
        // $prospecto->edad = $request['edad'];
        // $prospecto->primera_vez = $request['primera_vez'];
        // $prospecto->sexo = $request['sexo'];
        // $prospecto->modalidad = $request['modalidad'];
        // $prospecto->proceso = 'Enviada';
        // $prospecto->estatus = 'Activo';
        // $prospecto->save();


        // $agendar = Agenda::find($request['hora_cita']);
        // $agendar->prospecto_id = $prospecto['id'];
        // $agendar->proceso = 'Apartada';
        // $agendar->save();

        // return response()->json($agendar, 200);

        return $request;

    }
    public function obtenerHorario()
    {
        $especialistas = Especialista::
        // with('foto')->
        with([
                'horario_mañana' => function ($query) {
                    $query->whereDate('fecha', '>=', Carbon::today());
                }
            ])
            ->where('estatus', 'Activo')
            ->get();

        return response()->json($especialistas, 200);
    }
}