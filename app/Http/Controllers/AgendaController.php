<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function obtenerDias(Request $request)
    {
        $sem = $request['semana'];
        $a = $request['year'];
        $enero = mktime(1, 1, 1, 1, 1, $a);
        $mos = (11 - date('w', $enero)) % 7 - 3;
        $inicios = strtotime(($sem - 1) . ' weeks ' . $mos . ' days', $enero);
        for ($x = 0; $x <= 6; $x++) {
            $dias[] = date('d-m-Y', strtotime("+ $x day", $inicios));
            $dia[] = date('w', strtotime("+ $x day", $inicios));
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
}