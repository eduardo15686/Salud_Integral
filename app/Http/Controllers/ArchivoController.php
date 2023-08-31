<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function updateArchivo(Request $request)
    {
        $stringSeparado = explode('.', $request['nombre']);
        $foto = new Archivo();
        //$foto->user_id = Auth::user()->id;
        if ($request->hasfile("imagen")) {
            $imagen = $request->file("imagen");
            //$nombreimagen = Str::slug($request->imagen) . "." . $imagen->guessExtension();
            $imagen = $request->file("imagen")->store('public/archivos');
            $foto->ruta = $imagen;
            $foto->paciente_id = $request['paciente_id'];
            $foto->agenda_id = $request['agenda_id'];
            $foto->nombre = $stringSeparado[0];
            $foto->fecha = $request['fecha'];
            $foto->estatus = 'Activo';
        }
        if ($foto->save()) {
            return;
        }

    }

    public function getArchivos(Request $request)
    {
        $archivo = Archivo::where('fecha', $request['fecha'])
            ->where('paciente_id', $request['paciente_id'])
            ->where('estatus', 'Activo')
            ->get();

        return $archivo;
    }
}
