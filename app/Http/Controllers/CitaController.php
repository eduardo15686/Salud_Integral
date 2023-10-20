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
    public function about($id)
    {
        $especialista = Especialista::where('id', $id)
            ->first();

        //return json_encode(array(view('panels.citaId')->with('especialista', $especialista), 'especialista' => $especialista));
        // echo $especialista;

        return view('panels.citaId')->with('dato', $especialista);
    }

    public function agendarCitaId($id)
    {
        return $id;
    }
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
    public function getEspecialista(Request $request)
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
            ->where('id', $request['id'])
            ->get();

        return response()->json($especialistas, 200);

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
    public function agendarCita(Request $request)
    {

        $prospecto = new Prospecto();
        if ($request['servicios_id'] == 0) {
            $prospecto->servicios_id = null;
        } else {
            $prospecto->servicios_id = $request['servicios_id'];
        }

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

        $especialista = Especialista::where('user_id', $agendar['especialista_id'])
            ->where('estatus', 'Activo')
            ->first();

        $especialista['celular'] = str_replace("-", "", $especialista['celular']);
        // return $especialista;
        $message = 'Solicitud de cita.\n\nNombre: ' . $request['nombre'] .
            '\nFecha: ' . $agendar['fecha'] .
            '\nHora: ' . $agendar['hora'];

        $params = array(
            'token' => 'j9yrhy3r3l9f33ma',
            'to' => $especialista['celular'],
            'body' => $message
        );
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "https://api.ultramsg.com/instance62942/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

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