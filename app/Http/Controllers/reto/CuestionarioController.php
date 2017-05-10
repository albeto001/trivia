<?php

namespace App\Http\Controllers\reto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UsuariosRespuestas;

class CuestionarioController extends Controller
{
    public function guardar_resp(Request $request){
        if($request->ajax()){

            $respuestas = $request->input("respuesta", []);
            $respuestas_a = $request->input("respuesta_a", []);
            $usuario = $request -> session() -> get('usuario');
            //dd($usuario);            

            // Se registran las repuestas opcionales
            foreach ($respuestas as $id_preg => $respuesta) {
                UsuariosRespuestas::create(["id_usuario" => $usuario['id'], "id_pregunta" => $id_preg, "id_respuesta" => $respuesta]);
            }

            // Se registran las respuestas abiertas
            foreach ($respuestas_a as $id_preg => $respuesta) {
                UsuariosRespuestas::create(["id_usuario" => $usuario['id'], "id_pregunta" => $id_preg, "respuesta_abierta" => $respuesta]);
            }

            return "{}";
        }
    }
}
