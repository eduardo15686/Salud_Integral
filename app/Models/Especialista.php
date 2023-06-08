<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    public function servicio()
    {
        return $this->hasMany('App\Models\Especialista', 'id_servicio');
    }

    public function foto()
    {
        return $this->hasOne('App\Models\Foto', 'user_id', 'user_id');
    }

    static public function getRules()
    {
        return [
            'new_password' => 'required',
        ];
    }

    static public function getMessages()
    {
        return [
            'new_password.required' => 'El campo NOMBRE es requerido.',
        ];
    }
}