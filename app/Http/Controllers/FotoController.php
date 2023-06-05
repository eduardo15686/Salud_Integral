<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function obtenerLinkFoto()
    {
        $imagenPerfil = Foto::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();
        return asset('img/fotos/' . $imagenPerfil['imagen_path']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateFoto(Request $request)
    {
        $foto = new Foto();
        $foto->user_id = Auth::user()->id;

        if ($request->hasfile("imagen")) {
            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($request->imagen) . "." . $imagen->guessExtension();
            $ruta = public_path("img/fotos/");
            $imagen->move($ruta, $nombreimagen);

            $foto->imagen_path = $nombreimagen;
        }
        $foto->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        //
    }
}