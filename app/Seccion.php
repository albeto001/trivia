<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = "seccion";
    public $primaryKey = "id";
    protected $fillable = ["nombre", "id_trivia", "fecha_inicio", "fecha_fin", "estatus"];
    public $timestamps = false;
}
