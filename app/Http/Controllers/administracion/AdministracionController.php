<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trivia;

class AdministracionController extends Controller
{
    public function index(Request $request){
    	$usuario = $request -> session() -> get('usuario');
    	//dd($usuario);
        return view('trivia.administracion.dashboard')->with(array("usuario" => $usuario));
    }
}