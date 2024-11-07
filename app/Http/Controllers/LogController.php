<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // para generar nuevo registro de log
    public function newLog($id_usuario_modificador, $evento, $elemento_modificado)
    {
        $log = new log();
        $log->id_usuario_modificador = $id_usuario_modificador;
        $log->evento = $evento;
        $log->elemento_modificado = $elemento_modificado;
        $log->created_at = now();
        $log->save();
    }
}
