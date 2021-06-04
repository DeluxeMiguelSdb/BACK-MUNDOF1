<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Logic\ApliLogic;
use App\Providers\LogsHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    /**
     * Método para obtener las diferentes
     * consultas de clasificaciones actuales
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
     * Método para obtener consultas filtradas
     * en la página de estadísticas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $piloto = $request->piloto;
        $equipo = $request->equipo;
        $temporada = $request->temporada;
        $circuito = $request->circuito;
        $tipoBusqueda = $request->tipoBusqueda;
        $offSet = $request->offSet ?? null;
        $clasificacionesEstaticas = $request->clasificacionesEstaticas ?? null;
        $esConsultaApuesta = $request->esConsultaApuesta ?? null;

        if($clasificacionesEstaticas == null && !$esConsultaApuesta){
            $busquedaApi = ApliLogic::establecerUrl($piloto, $equipo, $temporada, $circuito, $tipoBusqueda, $offSet);

            event(new LogsHistory(
                Auth::id(),
                Auth::user()->nick,
                Config::get('constants.pages.page_estadisticas'),
                Config::get('constants.actions.filtered_search'),
            ));

        }else if($clasificacionesEstaticas == null && $esConsultaApuesta){
            $busquedaApi = ApliLogic::getProximaCarrera();
        }
        
        else{
            $busquedaApi = ApliLogic::establecerUrlClasificaciones($clasificacionesEstaticas);

            event(new LogsHistory(
                Auth::id(),
                Auth::user()->nick,
                Config::get('constants.pages.page_clasificaciones'),
                Config::get('constants.actions.see_clasificactions'),
            ));
        }
        
        

        return Http::get($busquedaApi);
    }

    public function recuperarResultado(){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
