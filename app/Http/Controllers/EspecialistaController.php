<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Prospecto;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Servicio;
use Carbon\Carbon;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoReal = [];
        $servicios_nombre = [];
        $infoReal = [];
        $guardarInfo = [];
        $servicios_nombre = [];
        $especialistas = Especialista::with('foto')
            ->where('estatus', 'Activo')
            ->get();


        foreach ($especialistas as $especialista) {

            $servicios_nombre = [];
            $servicios = explode(',', $especialista['servicio_id']);
            foreach ($servicios as $servicio) {
                $servicioInfo = Servicio::where('id', $servicio)
                    ->where('estatus', 'Activo')
                    ->first();
                array_push($servicios_nombre, $servicioInfo['text_html']);

            }
            $infoReal = [
                'especialista' => $especialista,
                'especialidad' => implode(", ", $servicios_nombre)
            ];

            array_push($guardarInfo, $infoReal);
        }


        //return response()->json($guardarInfo, 200);
        // 
        // $especialistas = Especialista::with('foto')
        //     ->where('estatus', 'Activo')
        //     ->get();
        return view('inicio', compact('guardarInfo'));

    }

    public function filtrar(Request $request)
    {
        // $servicio_id = implode(', ', $request['registro']);
        // $prospecto->especialista_id = $request['especialista'];
        // $prospecto->servicios_id = $servicio_id;
        // $prospecto = new Prospecto();
        // $prospecto->nombre = $request['nombre'];
        // $prospecto->correo = $request['correo'];
        // $prospecto->celular = $request['celular'];
        // $prospecto->edad = $request['edad'];
        // $prospecto->primera_vez = $request['primera_vez'];
        // $prospecto->sexo = $request['sexo'];
        // $prospecto->modalidad = $request['modalidad'];
        // $prospecto->proceso = 'Enviada';
        // $prospecto->estatus = 'Activo';
        // $prospecto->save();


        // $agendar = Agenda::find($request['hora_cita']);
        // $agendar->prospecto_id = $prospecto['id'];
        // $agendar->proceso = 'Apartada';
        // $agendar->save();
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
            'servicio_id' => 'required',
        ]);

        $servicio_id = implode(', ', $request['servicio_id']);

        $especialista = new Especialista();
        $especialista->user_id = Auth::user()->id;
        $especialista->nombre = $request['nombre'];
        $especialista->apellido_pat = $request['paterno'];
        $especialista->apellido_mat = $request['materno'];
        $especialista->titulo = $request['titulo'];
        $especialista->celular = $request['celular'];
        $especialista->correo = $request['correo'];
        $especialista->deposito = $request['deposito'];
        $especialista->precio_consulta = $request['precio_consulta'];
        $especialista->servicio_id = $servicio_id;
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
            $servicios = explode(',', $especialistaInfo['servicio_id']);
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
        
        $servicio_id = implode(', ', $request['nuevoServicio']);
        $especialista = Especialista::find($request['id']);
        $especialista->nombre = $request['nombre'];
        $especialista->apellido_pat = $request['apellido_pat'];
        $especialista->apellido_mat = $request['apellido_mat'];
        $especialista->titulo = $request['titulo'];
        $especialista->celular = $request['celular'];
        $especialista->correo = $request['correo'];
        $especialista->deposito = $request['deposito'];
        $especialista->precio_consulta = $request['precio_consulta'];
        $especialista->servicio_id = $servicio_id;
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

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);
        // #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password) == 1) {
            return ("Las contraseñas no coinciden");
        }

        if ($request->new_password != $request->new_password_confirmation) {
            return ("Las nuevas contraseñas no coinciden");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
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