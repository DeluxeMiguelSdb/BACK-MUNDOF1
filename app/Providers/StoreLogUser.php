<?php

namespace App\Providers;

use App\Models\log;
use App\Providers\LogsHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLogUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogsHistory  $event
     * @return void
     */
    public function handle(LogsHistory $event)
    {
        $idusuario = $event->idUsuario;
        $nick = $event->nick;
        $paginaAccedida = $event->paginaAccedida;
        $accion = $event->accion;

        $accionFormated = "El usuario $nick con id $idusuario ha accedido a "
                        ."$paginaAccedida y ha realizado la siguente accion: $accion";

        log::create([
            'users_id' => $idusuario,
            'descripcion' => $accionFormated,
        ]);
    }
}
