<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function generarAgenda(Request $request)
    {
        $primerhora = $request['fecha'] . ' ' . $request['primera'];
        $date1 = new DateTime($primerhora);
        $date2 = new DateTime("now");
        $diff = $date1->diff($date2);
        // 38 minutes to go [number is variable]
        echo (($diff->days * 24) * 60) + ($diff->i) . ' minutes';
        // passed means if its negative and to go means if its positive
        echo ($diff->invert == 1) ? ' passed ' : ' to go ';

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
}