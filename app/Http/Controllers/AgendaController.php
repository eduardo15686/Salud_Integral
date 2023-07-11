<?php

namespace App\Http\Controllers;


use App\Models\Especialista;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Horario;
use App\Models\Prospecto;
use App\Models\Paciente;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarCitaProspecto;

class AgendaController extends Controller
{
    public function generarAgenda(Request $request)
    {
        $primerhora = '';
        $segundahora = '';
        $primerhora_vesp = '';
        $segundahora_vesp = '';

        $fecha = new DateTime(Carbon::today());
        $semana = $fecha->format('W');
        $a = $fecha->format('Y');
        $sem = $semana + ($request['contador']);
        $enero = mktime(1, 1, 1, 1, 1, $a);
        $mos = (11 - date('w', $enero)) % 7 - 3;
        $inicios = strtotime(($sem - 1) . ' weeks ' . $mos . ' days', $enero);
        for ($x = 0; $x <= 6; $x++) {
            $dias[] = date('d-m-Y', strtotime("+ $x day", $inicios));
        }
        $res = ($dias);
        $horario = Horario::orderBy('dia', 'asc')
            ->where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->get();

        if (empty($horario[0]) && empty($horario[1]) && empty($horario[2]) && empty($horario[3]) && empty($horario[4]) && empty($horario[5]) && empty($horario[6])) {
            return 'vacio';
        } else {
            for ($j = 0; $j <= 6; $j++) {
                $primerhora = $res[$j] . ' ' . $horario[$j]['inicio_mat'];
                $segundahora = $res[$j] . ' ' . $horario[$j]['final_mat'];
                $minutos = (strtotime($primerhora) - strtotime($segundahora)) / 60;
                $minutos = abs($minutos);
                $minutos = floor($minutos);

                $numeroConsultas = $minutos / $horario[$j]['tiempo'];
                $NuevaFecha = date('H:i', strtotime($primerhora));

                if (floor($numeroConsultas) != 0) {
                    for ($i = 0; $i < floor($numeroConsultas); $i++) {
                        $fecha = new Agenda();
                        $fecha->especialista_id = Auth::user()->id;
                        $fecha->prospecto_id = 0;
                        $fecha->paciente_id = 0;
                        $fecha->tiempo = $horario[$j]['tiempo'];
                        $fecha->fecha = date("Y-m-d", strtotime($res[$j]));
                        $fecha->hora = $NuevaFecha;
                        $fecha->proceso = 'Disponible';
                        $fecha->estatus = 'Activo';
                        $fecha->created_by = Auth::user()->id;
                        $fecha->updated_by = Auth::user()->id;
                        $fecha->save();
                        $NuevaFecha = strtotime('+' . $horario[$j]['tiempo'] . 'minute', strtotime($NuevaFecha));
                        $NuevaFecha = date('H:i', $NuevaFecha);
                    }
                }
            }
            for ($j = 0; $j <= 6; $j++) {
                $primerhora_vesp = $res[$j] . ' ' . $horario[$j]['inicio_vesp'];
                $segundahora_vesp = $res[$j] . ' ' . $horario[$j]['final_vesp'];
                $minutos = (strtotime($primerhora_vesp) - strtotime($segundahora_vesp)) / 60;
                $minutos = abs($minutos);
                $minutos = floor($minutos);

                $numeroConsultas = $minutos / $horario[$j]['tiempo'];
                $NuevaFecha = date('H:i', strtotime($primerhora_vesp));

                if (floor($numeroConsultas) != 0) {
                    for ($i = 0; $i < floor($numeroConsultas); $i++) {
                        $fecha = new Agenda();
                        $fecha->especialista_id = Auth::user()->id;
                        $fecha->prospecto_id = 0;
                        $fecha->paciente_id = 0;
                        $fecha->tiempo = $horario[$j]['tiempo'];
                        $fecha->fecha = date("Y-m-d", strtotime($res[$j]));
                        $fecha->hora = $NuevaFecha;
                        $fecha->proceso = 'Disponible';
                        $fecha->estatus = 'Activo';
                        $fecha->created_by = Auth::user()->id;
                        $fecha->updated_by = Auth::user()->id;
                        $fecha->save();
                        $NuevaFecha = strtotime('+' . $horario[$j]['tiempo'] . 'minute', strtotime($NuevaFecha));
                        $NuevaFecha = date('H:i', $NuevaFecha);
                    }
                }
            }
        }

    }

    public function verAgenda(Request $request)
    {
        $fecha = new DateTime(Carbon::today());
        $semana = $fecha->format('W');
        $a = $fecha->format('Y');
        $sem = $semana + ($request['contador']);
        $enero = mktime(1, 1, 1, 1, 1, $a);
        $mos = (11 - date('w', $enero)) % 7 - 3;
        $inicios = strtotime(($sem - 1) . ' weeks ' . $mos . ' days', $enero);
        for ($x = 0; $x <= 6; $x++) {
            $dias[] = date('d-m-Y', strtotime("+ $x day", $inicios));
        }
        $res = ($dias);

        $lunes = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[0])))
            ->with([
                'prospecto' => function ($query) {
                    $query->with('servicios');
                }
            ])
            ->with('paciente')
            ->get();
        $martes = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[1])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $miercoles = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[2])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $jueves = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[3])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $viernes = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[4])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $sabado = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[5])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $domingo = Agenda::orderBy('hora', 'asc')
            ->where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[6])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        return response()->json([$lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $res], 200);

    }
    public function aceptarProspecto(Request $request)
    {
        $prospecto = Prospecto::find($request['prospecto']['id']);
        $prospecto->proceso = 'Aceptada';
        $prospecto->save();

        $paciente = new Paciente;
        $paciente->especialista_id = Auth::user()->id;
        $paciente->nombre = $request['prospecto']['nombre'];
        $paciente->correo = $request['prospecto']['correo'];
        $paciente->celular = $request['prospecto']['celular'];
        $paciente->sexo = $request['prospecto']['sexo'];
        $paciente->estatus = 'Activo';
        $paciente->save();

        $agendar = Agenda::find($request['id']);
        $agendar->paciente_id = $paciente['id'];
        $agendar->proceso = 'Agendada';
        $agendar->save();

        $especialista = Especialista::where('user_id', Auth::user()->id)->get();

        $pacienteInfo['nombre'] = $request['prospecto']['nombre'];
        $pacienteInfo['especialista'] = $especialista[0]['titulo'] . ' ' . $especialista[0]['nombre']
            . ' ' . $especialista[0]['apellido_pat'] . ' ' . $especialista[0]['apellido_mat'];
        $pacienteInfo['fecha'] = $agendar['fecha'];
        $pacienteInfo['hora'] = $agendar['hora'];
        $pacienteInfo['modalidad'] = $prospecto['modalidad'];
        $pacienteInfo['precio_consulta'] = $especialista[0]['precio_consulta'];


        // $files = [public_path('principal/assets/img/logo.png')];
        // Mail::to('eduardo15686@gmail.com')->send(new ConfirmarCitaProspecto($especialista));
        Mail::send('mails.aceptar_cita', $pacienteInfo, function ($message) use ($request) {
            $message->to($request['prospecto']['correo'])
                ->subject('Cita Confirmada "Salud Integral"');
        });
        return $especialista;
    }

    public function rechazarProspecto(Request $request)
    {
        $agendar = Agenda::find($request['id']);
        $agendar->proceso = 'Disponible';
        $agendar->prospecto_id = 0;
        $agendar->save();

        $prospecto = Prospecto::find($request['prospecto']['id']);
        $prospecto->proceso = 'Rechazada';
        $prospecto->save();

        $paciente['nombre'] = $request['prospecto']['nombre'];

        Mail::send('mails.rechazar_cita', $paciente, function ($message) use ($request) {
            $message->to($request['prospecto']['correo'])
                ->subject('Cita En Espera "Salud Integral"');
        });
    }

    public function inhabilitarHora(Request $request)
    {
        $agendar = Agenda::find($request['id']);
        $agendar->proceso = 'Inactiva';
        $agendar->save();
    }

    public function habilitarHora(Request $request)
    {
        $agendar = Agenda::find($request['id']);
        $agendar->proceso = 'Disponible';
        $agendar->save();
    }

    public function getPacientes(Request $request)
    {
        $paciente = Paciente::where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->get();

        return response()->json($paciente, 200);
    }

    public function agendarPaciente(Request $request)
    {
        $agendar = Agenda::find($request['id']);
        $agendar->paciente_id = $request['paciente_id'];
        $agendar->proceso = 'Agendada';
        $agendar->save();

        // return response()->json($paciente, 200);
    }

    public function agendarHoraEspecial(Request $request)
    {
        $fecha = new Agenda();
        $fecha->especialista_id = Auth::user()->id;
        $fecha->prospecto_id = 0;
        $fecha->paciente_id = $request['paciente_id'];
        $fecha->tiempo = $request['tiempo'];
        $fecha->fecha = $request['fecha'];
        $fecha->hora = $request['hora'];
        $fecha->proceso = 'Especial';
        $fecha->estatus = 'Activo';
        $fecha->created_by = Auth::user()->id;
        $fecha->updated_by = Auth::user()->id;
        $fecha->save();

    }

}