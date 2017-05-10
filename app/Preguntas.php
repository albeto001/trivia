<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    protected $table = "preguntas";
    public $primaryKey = "id";
    protected $fillable = ['id_seccion', 'pregunta', 'img', 'tipo', 'estatus'];
    public $timestamps = false;
}
