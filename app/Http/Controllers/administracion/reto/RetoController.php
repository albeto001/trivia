<?php

namespace App\Http\Controllers\administracion\reto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trivia;
class RetoController extends Controller
{
    public function index(Request $request){
    	$trivias = Trivia::select("*") -> where("estatus", 'Y')->get()->toArray();
    	$usuario = $request -> session() -> get('usuario');
    	//dd($usuario);
        return view('trivia.administracion.reto.reto')->with(array("usuario" => $usuario, 'trivias' => $trivias));

    }
    
    public function add(Request $request){
    	$trivia = [];
    	if($request->get("id", "") != "" ){
    		$trivia = Trivia::find($request->get("id"))->toArray();
    		//dd($trivia);
    	}
        return view('trivia.administracion.reto.modal.reto')->with($trivia);
    }
    
    public function guardar(Request $request){
    	if($request->ajax()){
    		$datos = ["nombre" => $request->get('nombre', ''), 
       			  	  "descripcion" => $request->get('comentario', ''),
       			  	  "fecha_inicio" => $request->get('fecha_n', ''),
       			  	  "fecha_fin" => $request->get('fecha_f', '')
       			 	 ]; 

    		
    		if($request->get('id', '')!=''){// si exciste el id se actualizara
    			$trivia = Trivia::where("id", $request->get('id', ''))->update($datos);
    			$trivia = Trivia::find($request->get("id"))->toArray();
    			//$trivia = $trivia->toArray();
    		}
    		else{
		       	$trivia = Trivia::create($datos);
		       	$trivia = $trivia->toArray();
		    }
	       	return response()-> json($trivia);
       }
       else{
       	// Sin accion
       }
    }

    public function desactivar(Request $request){
    	if($request->ajax()){
    		$reto = Trivia::find($request->get("id"));
    		$reto->estatus = "N";
    		$reto->save();
    		return "{}";
    	}
    }
}