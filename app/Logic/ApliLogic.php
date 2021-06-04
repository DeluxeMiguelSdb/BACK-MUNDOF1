<?php

namespace App\Logic;

use Illuminate\Support\Facades\Http;

class ApliLogic
{

    static public function establecerUrl($piloto, $equipo, $temporada, $circuito, $tipoBusqueda, $offSet)
    {
        $urlApiResult = "https://ergast.com/api/f1/";

        //Piloto, equipo, temporada, circuito
        if (
            !empty($piloto) && !empty($equipo)
            && !empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/drivers/$piloto/constructors/$equipo/circuits/$circuito/$tipoBusqueda.json";
        }
        //temporada, circuito, tipo busqueda
        if (
            empty($piloto) && empty($equipo)
            && !empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/circuits/$circuito/$tipoBusqueda.json";
        }
        //piloto, temporada, circuito, tipo busqueda
        if (
            !empty($piloto) && empty($equipo)
            && !empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/drivers/$piloto/circuits/$circuito/$tipoBusqueda.json";
        }
        //temporada, piloto, tipo busqueda
        if (
            !empty($piloto) && empty($equipo)
            && !empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/drivers/$piloto/$tipoBusqueda.json";
        }
        //circuito, tipo busqueda
        if (
            empty($piloto) && empty($equipo)
            && empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "circuits/$circuito/$tipoBusqueda.json";
        }


        //Piloto, equipo, temporada
        elseif (
            !empty($piloto) && !empty($equipo)
            && !empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/drivers/$piloto/constructors/$equipo/$tipoBusqueda.json";
        }
        //Piloto, circuito
        elseif (
            !empty($piloto) && empty($equipo)
            && empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "circuits/$circuito/drivers/$piloto/$tipoBusqueda.json";
        }

        //Piloto, equipo
        elseif (
            !empty($piloto) && !empty($equipo)
            && empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "drivers/$piloto/constructors/$equipo/$tipoBusqueda.json";
        }

        //Piloto SOLO
        elseif (
            !empty($piloto) && empty($equipo)
            && empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "drivers/$piloto/$tipoBusqueda.json";
        }

        //Equipo SOLO
        elseif (
            empty($piloto) && !empty($equipo)
            && empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "constructors/$equipo/$tipoBusqueda.json";
        }

        //Temporada SOLO
        elseif (
            empty($piloto) && empty($equipo)
            && !empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$temporada/$tipoBusqueda.json";
        }

        //circuito SOLO
        elseif (
            empty($piloto) && empty($equipo)
            && empty($temporada) && !empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "circuits/$circuito/$tipoBusqueda.json";
        }

        //Sin nada
        elseif (
            empty($piloto) && empty($equipo)
            && empty($temporada) && empty($circuito)
            && !empty($tipoBusqueda)
        ) {
            $urlApiResult .= "$tipoBusqueda.json";
        }

        if(!empty($offSet)){
            return $urlApiResult .="?offset=$offSet";
        }

        return $urlApiResult;
        
    }

    static public function establecerUrlClasificaciones($clasificacionesEstaticas)
    {
        $urlApiResult = "https://ergast.com/api/f1/";

        switch($clasificacionesEstaticas)
        {
            case 1:
                return $urlApiResult .= "current/last/results.json";

            case 2:
                return $urlApiResult .= "current/drivers.json";

            case 3:
                return $urlApiResult .= "current/constructorStandings.json";

            case 4:
                return $urlApiResult .= "current/driverStandings.json";
        }

        
    }

    static public function getResultadoCarrera($idCarrera,$primerPiloto,$segundoPiloto,$tercerPiloto,
                                                $equipoGanador,$safetyCar)
    {
        $urlApiResult = "https://ergast.com/api/f1/current/$idCarrera/results.json";
        
        $response = Http::get($urlApiResult);
        $resultado = json_decode($response,true);

        if(!isset($resultado['MRData']['RaceTable']['Races'][0])) return "sindefinir";
        $resultado = $resultado['MRData']['RaceTable']['Races'][0]['Results'];

        if($resultado[0]['Driver']['driverId'] == $primerPiloto && $resultado[1]['Driver']['driverId'] == $segundoPiloto
            && $resultado[2]['Driver']['driverId'] == $tercerPiloto && $resultado[0]['Constructor']['constructorId'] == $equipoGanador)
            {
                return true;
            }
        else
        {
            return false;
        }

        
    }

    static public function getProximaCarrera()
    {
        return "https://ergast.com/api/f1/current/next.json";
    }
}
