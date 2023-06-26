@extends('layouts.app')
@section('content')

<?php
    $actual = Session::get('useradmin.permisoActual.0');

    $listaPermisos = Session::get('useradmin.permisos.0');
    $llave_array = array_search($actual, array_column($listaPermisos, 'parent_id'));    
    $opcionesVista = array();
    $opcionesVistaBoton = array();
    while ($llave_array != NULL)
    {
        if($listaPermisos[$llave_array]['categoria'] == 'Opcion')
            $opcionesVista[] = $listaPermisos[$llave_array];

            
        elseif($listaPermisos[$llave_array]['categoria'] == 'Boton')
            $opcionesVistaBoton[] = $listaPermisos[$llave_array];

        array_splice($listaPermisos,$llave_array,1);
        $llave_array = array_search($actual, array_column($listaPermisos, 'parent_id'));
    }

?>

<pacientes :opciones="{{json_encode($opcionesVista)}}" :opcionesboton="{{json_encode($opcionesVistaBoton)}}"></pacientes>

@endsection