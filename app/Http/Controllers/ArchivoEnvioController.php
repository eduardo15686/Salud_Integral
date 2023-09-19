<?php

namespace App\Http\Controllers;

use App\Models\ArchivoEnvio;
use Auth;
use Illuminate\Http\Request;

class ArchivoEnvioController extends Controller
{
    public function updateArchivo(Request $request)
    {
        $stringSeparado = explode('.', $request['nombre']);
        $foto = new ArchivoEnvio();
        $foto->especialista_id = Auth::user()->id;
        if ($request->hasfile("imagen")) {
            $imagen = $request->file("imagen");
            //$nombreimagen = Str::slug($request->imagen) . "." . $imagen->guessExtension();
            $imagen = $request->file("imagen")->store('public/envios');
            $foto->ruta = $imagen;
            $foto->nombre = $stringSeparado[0];
            $foto->estatus = 'Activo';
        }
        if ($foto->save()) {
            return;
        }

    }

    public function getArchivos(Request $request)
    {
        $archivo = ArchivoEnvio::where('especialista_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->get();

        return $archivo;
    }
}