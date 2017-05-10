<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  	protected $table = 'usuarios';
  	public $primaryKey = "id";
  	protected $fillable = ['nombre', 'apellido_P', 'apellido_M', 'fecha_nacimineto', 'login', 'pass', 'tipo', 'ciudad', 'estado', 'email', 'refaccionaria', 'refaccionarioa_nombre', 'estudiante', 'escuela', 'contacto', 'estatus'];
  	public $timestamps = false;
  	protected $hidden = ['pass'];
}
