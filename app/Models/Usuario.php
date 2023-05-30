<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permiso;

class Usuario extends Model
{
    use HasFactory;

    public function perfil()
    {
        return $this->hasOne('App\Models\Permiso');
    }
}

