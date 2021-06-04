<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogsHistory
{

    //Este método es usado para llamar al listener
    //para ejecutar la accion que deseemos.
    //En el constructor establecemos los parametros
    //que va a recibir dicho escuchador para ejecutar la acción
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($idUsuario,$nick,$paginaAccedida,$accion)
    {
        $this->idUsuario = $idUsuario;
        $this->nick = $nick;
        $this->paginaAccedida = $paginaAccedida;
        $this->accion = $accion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
