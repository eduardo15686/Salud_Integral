<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    public function servicio()
    {
        return $this->hasMany('App\Models\Especialista', 'servicio_id');
    }

    public function horario_mañana()
    {
        return $this->hasMany('App\Models\Agenda', 'especialista_id', 'user_id')
            ->where('proceso', 'Disponible')
            ->whereTime('hora', '>=', '00:00:00')
            ->whereTime('hora', '<=', '11:00:00');
    }
    public function horario_tarde()
    {
        return $this->hasMany('App\Models\Agenda', 'especialista_id', 'user_id')
            ->where('proceso', 'Disponible')
            ->whereTime('hora', '>=', '12:00:00')
            ->whereTime('hora', '<=', '24:00:00');
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