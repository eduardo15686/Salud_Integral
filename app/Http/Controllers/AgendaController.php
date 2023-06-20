<?php

namespace App\Http\Controllers;


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
        //$contador = $request['contador'];
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
        $horario = Horario::all()
            ->where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo');

        for ($j = 0; $j <= 6; $j++) {
            $primerhora = $res[$j] . ' ' . $horario[$j]['inicio_mat'];
            $segundahora = $res[$j] . ' ' . $horario[$j]['final_mat'];
            $minutos = (strtotime($primerhora) - strtotime($segundahora)) / 60;
            $minutos = abs($minutos);
            $minutos = floor($minutos);

            $numeroConsultas = $minutos / $horario[$j]['tiempo'];
            $NuevaFecha = date('H:i', strtotime($primerhora));

            if ($numeroConsultas != 0) {
                for ($i = 0; $i < $numeroConsultas; $i++) {
                    $fecha = new Agenda();
                    $fecha->especialista_id = Auth::user()->id;
                    $fecha->prospecto_id = 0;
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

            if ($numeroConsultas != 0) {
                for ($i = 0; $i < $numeroConsultas; $i++) {
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

        $lunes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[0])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $martes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[1])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $miercoles = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[2])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $jueves = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[3])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $viernes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[4])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $sabado = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[5])))
            ->with('prospecto')
            ->with('paciente')
            ->get();
        $domingo = Agenda::where('estatus', 'Activo')
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
        //Mail::to('eduardo15686@gmail.com')->send(new ConfirmarCitaProspecto());
    }

    public function rechazarProspecto(Request $request)
    {
        $agendar = Agenda::find($request['id']);
        $agendar->proceso = 'Disponible';
        $agendar->prospecto_id = 0;
        $agendar->save();

        $prospecto = Prospecto::find($request['prospecto']['id']);
        $prospecto->proceso = 'Aceptada';
        $prospecto->save();
        //Mail::to('eduardo15686@gmail.com')->send(new ConfirmarCitaProspecto());
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


}