<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
  	protected $table = 'estados';
  	public $primaryKey = "id";
  	protected $fillable = ['nombre'];
  	public $timestamps = false;
  	
}
