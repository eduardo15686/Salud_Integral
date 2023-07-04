<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function generarHorario(Request $request)
    {
        $horario = new Horario();
        $horario->especialista_id = Auth::user()->id;
        $horario->tiempo = $request['tiempoConsulta'];
        $horario->dia = $request['dia'];
        $horario->inicio_mat = $request['inicio_mat'];
        $horario->final_mat = $request['final_mat'];
        $horario->inicio_vesp = $request['inicio_vesp'];
        $horario->final_vesp = $request['final_vesp'];
        $horario->estatus = 'Activo';
        if ($horario->save())
            return json_encode(['message' => 'Datos Guardados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    public function modificarHorario(Request $request)
    {
        $horario = Horario::find($request['id']);
        $horario->tiempo = $request['tiempoConsulta'];
        $horario->inicio_mat = $request['inicio_mat'];
        $horario->final_mat = $request['final_mat'];
        $horario->inicio_vesp = $request['inicio_vesp'];
        $horario->final_vesp = $request['final_vesp'];

        if ($horario->save())
            return json_encode(['message' => 'Datos Editados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }


    public function getHorario()
    {
        $horarioCount = Horario::where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->count();

        $horario = Horario::orderBy('dia', 'asc')
            ->where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->get();

        return [$horario, $horarioCount];
    }


    public function obtenerDias()
    {
        $a = array(
            [
                'dia' => 'Lunes',
                'value' => 0,
            ],
            [
                'dia' => 'Martes',
                'value' => 1,
            ],
            [
                'dia' => 'Miercoles',
                'value' => 2,
            ],
            [
                'dia' => 'Jueves',
                'value' => 3,
            ],
            [
                'dia' => 'Viernes',
                'value' => 4,
            ],
            [
                'dia' => 'Sabado',
                'value' => 5,
            ],
            [
                'dia' => 'Domingo',
                'value' => 6,
            ],
        );
        return $a;
    }

    public function getHoras()
    {
        $arr = array();
        //Haces un for de 24 horas
        for ($i = 360; $i < 1350; ) {
            $x = "midnight +" . $i . " minute";
            $z = date('H:i', strtotime($x));
            array_push($arr, $z);
            $i = $i + 30;
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