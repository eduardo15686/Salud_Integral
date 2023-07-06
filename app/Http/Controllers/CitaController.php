<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialista;
use App\Models\Foto;
use App\Models\Prospecto;
use App\Models\Agenda;
use App\Http\Requests\CitaRequest;


use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function getEspecialistasFiltro(Request $request)
    {
        $nuevaLista = [];
        foreach ($request['especialista'] as $valor) {
            $fecha = $request['fecha'];

            $especialistas = Especialista::where('id', $valor['id'])
                ->with('foto')
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
            array_push($nuevaLista, $especialistas);
        }
        return $nuevaLista;
    }
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

        return response()->json($especialistas, 200);

    }
    public function agendarCita(CitaRequest $request)
    {

        $prospecto = new Prospecto();
        //$servicio_id = implode(', ', $request['registro']);
        //$prospecto->especialista_id = $request['especialista'];
        $prospecto->servicios_id = $request['servicios_id'];
        $prospecto->nombre = $request['nombre'];
        $prospecto->correo = $request['correo'];
        $prospecto->celular = $request['celular'];
        $prospecto->edad = $request['edad'];
        $prospecto->primera_vez = $request['primera_vez'];
        $prospecto->sexo = $request['sexo'];
        $prospecto->modalidad = $request['modalidad'];
        $prospecto->comentarios = $request['comentario'];
        $prospecto->proceso = 'Enviada';
        $prospecto->estatus = 'Activo';
        $prospecto->save();


        $agendar = Agenda::find($request['hora_cita']);
        $agendar->prospecto_id = $prospecto['id'];
        $agendar->proceso = 'Apartada';
        $agendar->save();

        return [
            'nombre.required' => 'es necessadfaf',
        ];

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

    public function getSubCategorias()
    {
        $usuarios = Servicio::where('estatus', 'Activo')
            ->where('categoria', 'Nivel_3')
            ->get();
        return response()->json($usuarios, 200);
    }
}