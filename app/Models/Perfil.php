<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $table = 'perfiles';

    protected $fillable = [
        'nombre_perfil'
    ];

    public function Permisos()
    {
        return $this->belongsTo('App\Models\Permiso')->orderBy('orden','asc');
    }

    static public function getRules(){
        return [            
            'nombre_perfil' => 'required|unique:perfiles,nombre_perfil',                        
        ];
    }

    static public function getMessages()
    {
        return [            
            'nombre_perfil.required' => 'El campo NOMBRE es requerido.',
            'nombre_perfil.unique' => 'El NOMBRE del PERFIL ya existe. Intente con otro.'
        ];
    }
}
