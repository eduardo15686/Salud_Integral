<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agenda extends Model
{
    use HasFactory;


    public function prospecto()
    {
        return $this->belongsTo('App\Models\Prospecto');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Models\Paciente');
    }
}