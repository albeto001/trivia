<?php

namespace App\Http\Controllers\administracion\preguntas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Preguntas;
use App\Respuestas;
use App\Seccion;
use App\UsuariosRespuestas;
use DB;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $preguntas = Preguntas::select("preguntas.id", 
                                        "pregunta",
                                        "sec.nombre as seccion",
                                        DB::raw("if(tipo='A', 'Abierta', 'Opcional') as tipo"),
                                        DB::raw("count(preguntas.id) as nRespuestas"),
                                        DB::raw("ifnull(max(resp.puntuacion1), '?') as maximaPuntuacion")
                                        )
                    ->join("seccion as sec", "sec.id", "=", "id_seccion")
                    ->leftjoin("respuestas as resp", "id_pregunta", "=", DB::raw("preguntas.id and resp.estatus = 'Y'"))
                    ->where("preguntas.estatus", "Y")
                    ->where("sec.estatus", "Y")
                    //->where("resp.estatus", "Y")

                    ->groupby("preguntas.id")
                    ->orderby("sec.fecha_inicio", "sec.nombre")
                    ->get()->toArray();

        //dd($preguntas);
        $usuario = $request -> session() -> get('usuario');

        return view('trivia.administracion.preguntas.preguntas')->with(array("usuario" => $usuario, 'preguntas' => $preguntas));
    }

    Public function add(Request $request){
        $secciones = Seccion::select("*")->where("estatus", "Y")->where("fecha_fin", ">", date("Y-m-d"))->orderby('nombre')->get()->toArray();
        $pregunta = [];
        $respuestas = [];
        if($request->input("id", "") != ""){
            $pregunta = Preguntas::find($request->input("id"))->toArray();
            $respuestas = Respuestas::select("*")->where("id_pregunta", $request->input("id"))->where("estatus", "Y")->get()->toArray();
        }
        
        return view('trivia.administracion.preguntas.modal.preguntas')->with(["cuestionarios" => $secciones, "pregunta" => $pregunta, "respuestas" => $respuestas]);
    }

    public function guardar(Request $request){
        
        if($request->ajax()){
            
            $datos = ["id_seccion" => $request->input("id_seccion", ""), "pregunta" => $request->input("pregunta", ""), "tipo" => $request->input("tipo", "")];
            //respuestas y puntos nuevos
            $respuestas = $request->input("respuesta", []);
            $puntos = $request->input("puntos", []);

            //Respuestas y puntos exsistentes
            $respuestas_ex = $request->input("respuesta_ex", [] );
            $puntos_ex = $request->input("puntos_ex", [] );
            
            if($request->input("id", "") == ""){
                //Se registra la pregunta
                $id_pregunta = Preguntas::create($datos)->id;

                //se sube la imagen en caso de excistir
                if(!empty($request->file()) && $request->file("img")->isValid()){
                    $file = $request->file("img");
                    if(!file_exists(public_path() . "/imagenes_preguntas")){
                        mkdir(public_path() . "/imagenes_preguntas", 0777);
                    }
                    $ext = $file->getClientOriginalExtension();
                    $new_name = "$id_pregunta.$ext";
                    $file->move(public_path() . "/imagenes_preguntas", $new_name);
                    $pregunta = Preguntas::find($id_pregunta);
                    $pregunta->img = url('/') . "/imagenes_preguntas/" . $new_name;
                    $pregunta->save();

                }
                // Se registran las respuestas
                if(is_array($respuestas) && $request->input("tipo", "") != "A"){
                    foreach ($respuestas as $key => $respuesta) {
                        Respuestas::create(["id_pregunta" => $id_pregunta, "respuesta" => $respuesta, "puntuacion1" => $puntos[$key], "puntuacion2" => $puntos[$key]]);
                    }
                }
            }
            else{
                // Se actualiza la pregunta excistente
                $id_pregunta = $request->input("id");

                Preguntas::where("id", $id_pregunta)->update($datos);

                if((!empty($respuestas) || !empty($respuestas_ex)) && $request->input("tipo", "") != "A"){

                    //Se actualizan las respuestas exsistentes
                    Respuestas::where("id_pregunta", $id_pregunta)->update(["estatus" => "N"]);
                    
                    foreach ($respuestas_ex as $key => $respuesta) {
                        Respuestas::where("id", $key)->update(["respuesta" => $respuesta, "puntuacion1" => $puntos_ex[$key], "puntuacion2" => $puntos_ex[$key], "estatus" => "Y" ]);
                        //dd($respuesta);
                    }

                    // Se registran las respuestas nuevas
                    foreach ($respuestas as $key => $respuesta) {
                        Respuestas::create(["id_pregunta" => $id_pregunta, "respuesta" => $respuesta, "puntuacion1" => $puntos[$key], "puntuacion2" => $puntos[$key]]);
                    }

                }
                else{
                    Respuestas::where("id_pregunta", $id_pregunta)->update(["estatus" => "N"]);
                }
                //se sube la imagen en caso de excistir
                if(!empty($request->file()) && $request->file("img")->isValid()){
                    $file = $request->file("img");
                    if(!file_exists(public_path() . "/imagenes_preguntas")){
                        mkdir(public_path() . "/imagenes_preguntas", 0777);
                    }
                    $ext = $file->getClientOriginalExtension();
                    $new_name = "$id_pregunta.$ext";
                    //dd($new_name);
                    $file->move(public_path() ."/imagenes_preguntas", $new_name);
                    $pregunta = Preguntas::find($id_pregunta);
                    $pregunta->img = url('/') . "/imagenes_preguntas/" . $new_name;
                    $pregunta->save();

                }

            }
            
            return "{}";
        }
    }

    public function desactivar(Request $request){
        if($request->ajax()){
            $id = $request->input("id");
            return response() -> json(Preguntas::where("id", $id)->update(["estatus" => "N"]));
        }
    }

    public function calificar(Request $request, $calificadas = 0){
        $preguntas = Preguntas::select('preguntas.id',
                        'preguntas.pregunta', 
                        DB::raw('sum( if(usu_r.id is null, 0, 1) ) as n_respuestas'))
                ->leftjoin('usuarios_respuestas as usu_r', 'usu_r.id_pregunta', '=', 'preguntas.id')
                ->where('preguntas.tipo', '=', 'A')
                ->where('preguntas.estatus', '=', 'Y')
                ->having("n_respuestas", ">", "0");
        
        if($calificadas == 0){
            $preguntas = $preguntas->whereNull("usu_r.puntuacion_abierta");
        }
        else{
            $preguntas = $preguntas ->whereNotNull("usu_r.puntuacion_abierta");
        }
                
        $preguntas = $preguntas->groupby('preguntas.id') ->get()->toArray();
        //dd($preguntas);

        $usuario = $request -> session() -> get('usuario');

        return view('trivia.administracion.preguntas.califica')->with(array("usuario" => $usuario, "preguntas" => $preguntas, "st" => $calificadas));
    }
    
    public function calificadas(Request $request){
       return $this->calificar($request, $calificadas = 1); 
    }

    public function calificar_respuestas(Request $request){
        if($request->ajax()){

            $pregunta = Preguntas::find($request->input("id"))->toArray();
            $pregunta = $pregunta['pregunta'];
            
            $respuestas = UsuariosRespuestas::select("usuarios_respuestas.id",
                                                    "usuarios_respuestas.respuesta_abierta",
                                                    "usuarios_respuestas.puntuacion_abierta as puntos")
                            ->join("preguntas as pre", "pre.id", "=", "usuarios_respuestas.id_pregunta")
                            ->where("pre.tipo", 'A')->where("pre.id", $request->input("id"));
            
            if((int) $request->input("st") == 0){                
                $respuestas = $respuestas->whereNull("usuarios_respuestas.puntuacion_abierta");
            }
            else{
                $respuestas = $respuestas->whereNotNull("usuarios_respuestas.puntuacion_abierta");
            }
            
            $respuestas = $respuestas->get()->toArray();
            //dd($respuestas);

            return view('trivia.administracion.preguntas.modal.califica')->with(array("respuestas" => $respuestas, "pregunta" => $pregunta));
        }
    }

    public function guardar_calificaciones(Request $request){
        if($request->ajax()){
            $puntos = $request->input("puntos", []);

            foreach ($puntos as $id => $value) {
                if($value != ""){
                    $resp = UsuariosRespuestas::find($id);
                    $resp -> puntuacion_abierta = (int)$value;
                    $resp->save();
                }
            }
            return "{}";
        }
    }
}
