<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;

    public function servicios()
    {
        return $this->belongsTo('App\Models\Servicio',);
    }
}
