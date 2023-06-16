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
        // $primerhora = $request['fecha'] . ' ' . $request['primera'];
        // $segundahora = $request['fecha'] . ' ' . $request['segunda'];
        // $minutos = (strtotime($primerhora) - strtotime($segundahora)) / 60;
        // $minutos = abs($minutos);
        // $minutos = floor($minutos);

        // $numeroConsultas = $minutos / $request['tiempoConsulta'];
        // $NuevaFecha = date('H:i', strtotime($primerhora));

        // for ($i = 0; $i < $numeroConsultas; $i++) {
        //     echo $NuevaFecha . '<br>';

        //     $fecha = new Agenda();
        //     $fecha->especialista_id = Auth::user()->id;
        //     $fecha->prospecto_id = 0;
        //     $fecha->tiempo = $request['tiempoConsulta'];
        //     $fecha->dia = $request['dia'];
        //     $fecha->fecha = date("Y-m-d", strtotime($request['fecha']));
        //     $fecha->hora = $NuevaFecha;
        //     $fecha->proceso = 'Disponible';
        //     $fecha->estatus = 'Activo';
        //     $fecha->created_by = Auth::user()->id;
        //     $fecha->updated_by = Auth::user()->id;
        //     $fecha->save();
        //     $NuevaFecha = strtotime('+' . $request['tiempoConsulta'] . 'minute', strtotime($NuevaFecha));
        //     $NuevaFecha = date('H:i', $NuevaFecha);

        // }.
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
        for ($i = 5; $i < 22; $i++) {
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