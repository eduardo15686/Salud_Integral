<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;

class PermisoController extends Controller
{
    public function GetPermisos()
    {
        $permisos = Permiso::find(1)
            ->where('categoria', 'Menu')
            //->where('categoria', 'Boton')
            ->where('categoria', '!=', 'submenu')
            ->with(['submenus' => function ($query) {
                $query->where('categoria', '=', 'Submenu');
                $query->with(['opcionessub']);
            }, 'opciones' => function ($query) {
                $query->where('categoria', '!=', 'Submenu')
                    ->where('categoria', '!=', 'Menu');
            }])
            ->get();
        echo $permisos;
    }
}
