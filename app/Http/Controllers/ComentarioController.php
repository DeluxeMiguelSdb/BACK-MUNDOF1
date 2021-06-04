<?php

namespace App\Http\Controllers;

use App\Models\comentario;
use App\Providers\LogsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comentario = comentario::findorFail($id);
        if ($comentario->delete()) {
            return response()->json(['Borrado Correctamente'], 200);
        }
    }

    public function eliminarcomentario($id)
    {
        $comentario = comentario::findorFail($id);

        event(new LogsHistory(
            Auth::user()->id,
            Auth::user()->nick,
            Config::get('constants.pages.page_noticia'),
            Config::get('constants.actions.delete_comment'),
        ));
        
        if ($comentario->delete()) {
            return response()->json(['Borrado Correctamente'], 200);
        }
    }

    public function addComentario(Request $request){
        
        $comentario = comentario::create([
            'contenido' => $request->contenido,
            'idNoticia' => $request->idNoticia,
            'idUsuario' => $request->idUsuario,
            'nombreUsuario' => $request->nombreUsuario,
        ]);

        event(new LogsHistory(
            Auth::user()->id,
            Auth::user()->nick,
            Config::get('constants.pages.page_noticia'),
            Config::get('constants.actions.add_comment'),
        ));


        return response()->json([$comentario->id], 200);

    }
}
