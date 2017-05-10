<?php

namespace App\Http\Controllers\administracion\seccion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Seccion;
use App\Trivia;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $secciones = Seccion::select("seccion.*", "t.id as id_t", "t.nombre as t_nombre")->join("trivia as t", "seccion.id_trivia", "=", "t.id")->where("seccion.estatus", "Y")->get()->toArray();
        $usuario = $request -> session() -> get('usuario');
        return view('trivia.administracion.seccion.seccion')->with(array("usuario" => $usuario, 'secciones' => $secciones));
    }
    
    public function add(Request $request){
        
        $trivias = Trivia::select("*")->where("estatus", "Y")->get()->toArray();
        $ronda = [];
        if($request->get("id", "") != ""){
            $ronda = Seccion::select("*")->where("id", $request->get("id"))->first()->toArray();
        }
        return view('trivia.administracion.seccion.modal.seccion')->with(["trivias"=>$trivias, "ronda" => $ronda]);
    }
    
    public function guardar(Request $request){
        if($request->ajax()){
            if($request->get("id", "")==""){
                $seccion = Seccion::create($request->all())->id;
                $seccion = Seccion::find($seccion)->toArray();
            }
            else{
                $seccion = Seccion::where("id", $request->get("id"))->update($request->except(['_token']));
                $seccion = Seccion::find($request->get("id"))->toArray();
                //dd($seccion);
            }

            return response()-> json($seccion);
        }
    }

    public function desactivar(Request $request){
        if($request->ajax()){
            $seccion = Seccion::find($request->get("id"));
            $seccion->estatus = "N";
            $seccion->save();
            return "{}";
        }
    }
    
}
