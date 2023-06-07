<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Prospecto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function cita()
    {
        $servicios = Servicio::where('categoria', 'Nivel_2')
            ->get();
        $especialistas = Especialista::with('foto')->get();
        return view('citas', compact('servicios', 'especialistas'));
    }

    public function filtrar(Request $request)
    {
        $servicio_id = implode(', ', $request['registro']);
        $prospecto = new Prospecto();
        $prospecto->especialista_id = $request['especialista'];
        $prospecto->servicios_id = $servicio_id;
        $prospecto->nombre = $request['nombre'];
        $prospecto->correo = $request['correo'];
        $prospecto->celular = $request['celular'];
        $prospecto->edad = $request['edad'];
        $prospecto->primera_vez = $request['primera_vez'];
        $prospecto->proceso = 'Enviada';
        $prospecto->estatus = 'Activo';
        $prospecto->save();

        return view('finalizado');
    }

    public function guardarEspecialista(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'titulo' => 'required',
            'celular' => 'required',
            'correo' => 'required',
            'id_servicio' => 'required',
        ]);

        $id_servicio = implode(', ', $request['id_servicio']);

        $especialista = new Especialista();
        $especialista->user_id = Auth::user()->id;
        $especialista->nombre = $request['nombre'];
        $especialista->apellido_pat = $request['paterno'];
        $especialista->apellido_mat = $request['materno'];
        $especialista->titulo = $request['titulo'];
        $especialista->celular = $request['celular'];
        $especialista->correo = $request['correo'];
        $especialista->deposito = $request['deposito'];
        $especialista->id_servicio = $id_servicio;
        $especialista->descripcion = $request['descripcion'];
        $especialista->slug = '';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Datos Guardados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getInfoEspecialista()
    {
        $servicios_nombre = [];
        $especialistaInfo = Especialista::where('user_id', Auth::user()->id)
            ->where('estatus', 'Activo')
            ->first();

        if (!empty($especialistaInfo)) {
            $servicios = explode(',', $especialistaInfo['id_servicio']);
            foreach ($servicios as $servicio) {
                $servicioInfo = Servicio::where('id', $servicio)
                    ->where('estatus', 'Activo')
                    ->first();
                array_push($servicios_nombre, $servicioInfo['text_html']);
            }
            $infoReal = [
                $especialistaInfo,
                implode(", ", $servicios_nombre)
            ];
            return response()->json([$infoReal, $especialistaInfo], 200);
        }
    }

    public function getSubCategorias()
    {
        $usuarios = Servicio::where('estatus', 'Activo')
            ->where('categoria', 'Nivel_3')
            ->get();
        return response()->json($usuarios, 200);
    }

    public function editarEspecialista(Request $request)
    {
        $id_servicio = implode(', ', $request['nuevoServicio']);
        $especialista = Especialista::find($request['id']);
        $especialista->nombre = $request['nombre'];
        $especialista->apellido_pat = $request['apellido_pat'];
        $especialista->apellido_mat = $request['apellido_mat'];
        $especialista->titulo = $request['titulo'];
        $especialista->celular = $request['celular'];
        $especialista->correo = $request['correo'];
        $especialista->deposito = $request['deposito'];
        $especialista->id_servicio = $id_servicio;
        $especialista->descripcion = $request['descripcion'];
        $especialista->slug = '';
        $especialista->estatus = 'Activo';
        $especialista->created_by = Auth::user()->id;
        $especialista->updated_by = Auth::user()->id;
        if ($especialista->save())
            return json_encode(['message' => 'Datos Editados Correctamente.'], 200);
        else
            return json_encode(['message' => 'Ocurrio un error, contacte al administrador del sistema.'], 401);
    }
    public function genSlug()
    {

        //$slug = rand(1,999999999);
        //$result = hash("sha256", $slug);
        $result = random_bytes(16);
        $slug = bin2hex($result);


        $validator = \Validator::make(['slug' => $slug], ['slug' => 'unique:clientes,slug']);

        if ($validator->fails()) {
            $this->genSlug();
        }

        return $slug;
    }
}