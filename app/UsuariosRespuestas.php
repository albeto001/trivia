<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosRespuestas extends Model
{
    protected $table = "usuarios_respuestas";
    public $primaryKey = "id";
    protected $fillable = ["id_usuario", "id_respuesta", "id_pregunta", "respuesta_abierta", "puntuacion_abierta", "fecha_respuesta"];
    public $timestamps = false;
}
