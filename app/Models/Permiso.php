<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //
    protected $table = 'permisos';
    protected $fillable = [
        'parent_id',
        'url',
        'text_html',
        'alt_html',
        'class',
        'function',
        'categoria',
        'orden',
        'origen',
    ];

    public function menus()
    {
        return $this->hasMany('App\Models\Permiso', 'parent_id');
    }

    public function submenus()
    {
        return $this->hasMany('App\Models\Permiso', 'parent_id');
    }

    public function opciones()
    {
        return $this->hasMany('App\Models\Permiso', 'parent_id');
    }


    public function opcionessub()
    {
        return $this->hasMany('App\Models\Permiso', 'parent_id');
    }
}
