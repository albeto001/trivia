<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    protected $table = 'respuestas';
    public $primaryKey = "id";
    protected $fillable = ["id_pregunta", "respuesta", "puntuacion1", "puntuacion2", "estatus"];
    public $timestamps = false;
}
