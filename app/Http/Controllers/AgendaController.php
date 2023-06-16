<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Horario;

class AgendaController extends Controller
{
    public function generarAgenda()
    {
        $fecha = new DateTime(Carbon::today());
        $semana = $fecha->format('W');
        $a = $fecha->format('Y');
        $sem = $semana;
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
                for ($i = 0; $i <= $numeroConsultas; $i++) {
                    $fecha = new Agenda();
                    $fecha->especialista_id = Auth::user()->id;
                    $fecha->prospecto_id = 0;
                    $fecha->tiempo = $horario[$j]['tiempo'];
                    $fecha->dia = '';
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
                ;
            }
        }
    }
    public function verAgenda()
    {
        $fecha = new DateTime(Carbon::today());
        $semana = $fecha->format('W');
        $a = $fecha->format('Y');
        $sem = $semana;
        $enero = mktime(1, 1, 1, 1, 1, $a);
        $mos = (11 - date('w', $enero)) % 7 - 3;
        $inicios = strtotime(($sem - 1) . ' weeks ' . $mos . ' days', $enero);
        for ($x = 0; $x <= 6; $x++) {
            $dias[] = date('d-m-Y', strtotime("+ $x day", $inicios));
        }
        $res = ($dias);

        $lunes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[0])))
            ->get();
        $martes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[1])))
            ->get();
        $miercoles = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[2])))
            ->get();
        $jueves = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[3])))
            ->get();
        $viernes = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[4])))
            ->get();
        $sabado = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[5])))
            ->get();
        $domingo = Agenda::where('estatus', 'Activo')
            ->where('fecha', date("Y-m-d", strtotime($res[6])))
            ->get();
        return response()->json([$lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo], 200);

    }
}