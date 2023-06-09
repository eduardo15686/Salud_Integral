<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function generarAgenda(Request $request)
    {
        $primerhora = $request['fecha'] . ' ' . $request['primera'];
        $segundahora = $request['fecha'] . ' ' . $request['segunda'];
        $minutos = (strtotime($primerhora) - strtotime($segundahora)) / 60;
        $minutos = abs($minutos);
        $minutos = floor($minutos);

        $numeroConsultas = $minutos / $request['tiempoConsulta'];
        $NuevaFecha = date('H:i', strtotime($primerhora));

        for ($i = 0; $i < $numeroConsultas; $i++) {
            echo $NuevaFecha . '<br>';

            $fecha = new Agenda();
            $fecha->especialista_id = Auth::user()->id;
            $fecha->prospecto_id = 0;
            $fecha->tiempo = $request['tiempoConsulta'];
            $fecha->dia = $request['dia'];
            $fecha->fecha = $request['fecha'];
            $fecha->hora = $NuevaFecha;
            $fecha->estatus = 'Activo';
            $fecha->created_by = Auth::user()->id;
            $fecha->updated_by = Auth::user()->id;
            $fecha->save();
            $NuevaFecha = strtotime('+' . $request['tiempoConsulta'] . 'minute', strtotime($NuevaFecha));
            $NuevaFecha = date('H:i', $NuevaFecha);

        }
    }

    public function obtenerDias(Request $request)
    {
        $sem = $request['semana'];
        $a = $request['year'];
        $enero = mktime(1, 1, 1, 1, 1, $a);
        $mos = (11 - date('w', $enero)) % 7 - 3;
        $inicios = strtotime(($sem - 1) . ' weeks ' . $mos . ' days', $enero);
        for ($x = 0; $x <= 6; $x++) {
            $dias[] = date('d-m-Y', strtotime("+ $x day", $inicios));
        }
        $res = ($dias);
        return $res;
    }
    public function getSemanas()
    {
        $array = [];
        $empujar = [];
        for ($i = 1; $i <= 53; $i++) {
            $empujar = [
                'value' => $i,
                'nombre' => 'Semana ' . $i
            ];
            array_push($array, $empujar);
        }
        return $array;
    }

    public function getHoras()
    {
        $arr = array();
        //Haces un for de 24 horas
        for ($i = 0; $i < 24; $i++) {
            $x = "midnight +" . $i . " hour";
            $z = date('H:i', strtotime($x));
            array_push($arr, $z);
        }
        return $arr;
    }

    public function tiempoConsulta()
    {
        $array = [];
        $empujar = [];
        for ($i = 30; $i <= 120; ) {
            $empujar = [
                'value' => $i,
                'nombre' => $i . ' minutos'
            ];
            array_push($array, $empujar);
            $i = $i + 10;
        }
        return $array;
    }
}