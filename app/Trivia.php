<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{
    protected $table = "trivia";
    public $primaryKey = "id";
    protected $fillable = ["nombre", "descripcion", "fecha_inicio", "fecha_fin", "estatus"];
    public $timestamps = false;
}
