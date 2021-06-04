<?php

namespace App\Http\Controllers;

use App\Logic\ApliLogic;
use App\Models\apuesta;
use App\Providers\LogsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ApuestaController extends Controller
{
    public function getApuesta(Request $request)
    {
        $apuesta = apuesta::where([['users_id','=',Auth::user()->id],['idCarrera','=',$request->idCarrera]])->firstOrFail();

        return response()->json(['Mensaje' => 'Registro encontrado'], 200);
    }

    public function getApuestasByIdUser()
    {
        $apuestas = apuesta::where('users_id','=',Auth::user()->id)->get();

        foreach ($apuestas as &$apuesta) {
            $apuesta->esCorrecta = ApliLogic::getResultadoCarrera($apuesta->idCarrera, $apuesta->primerPiloto,
                                                                    $apuesta->segundoPiloto,$apuesta->tercerPiloto,
                                                                    $apuesta->equipoGanador,$apuesta->safetyCar);
        }

        return $apuestas;
    }
    //
    public function registrarApuesta(Request $request)
    {


        $apuesta = apuesta::create([
            'idCarrera' => $request->idCarrera,
            'nombreCarrera' => $request->nombreCarrera,
            'primerPiloto' => $request->primerPiloto,
            'segundoPiloto' => $request->segundoPiloto,
            'tercerPiloto' => $request->tercerPiloto,
            'equipoGanador' => $request->equipoGanador,
            'safetyCar' => $request->safetyCar,
            'esCorrecta' =>$request->esCorrecta,
            'users_id' => Auth::user()->id,
        ]);

        event(new LogsHistory(
            Auth::id(),
            Auth::user()->nick,
            Config::get('constants.pages.page_apuestas'),
            Config::get('constants.actions.make_bet'),
        ));


        return response()->json(['Mensaje' => 'Usuario registrado con exito'], 200);
    }


}
