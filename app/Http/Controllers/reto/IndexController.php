<?php

namespace App\Http\Controllers\reto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trivia;
use App\Seccion;
use App\Preguntas;
use App\Respuestas;
use App\UsuariosRespuestas;
use App\Usuario;

use DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $usuario = $request -> session() -> get('usuario');
        //dd($usuario);
        $top = Usuario:: select ("usuarios.id", 
                    DB::raw('concat(usuarios.nombre, " ", usuarios.apellido_P, " ", usuarios.apellido_M) as usuario'),
                    "usuarios.login",
                    DB::raw("(sum(ifnull(resp.puntuacion1,0)) ) + (sum(ifnull(usu_res.puntuacion_abierta,0))) as puntos"))
            ->leftJoin("usuarios_respuestas as usu_res", "usuarios.id", "=", "usu_res.id_usuario")
            ->leftJoin("respuestas as resp", "usu_res.id_respuesta", "=", "resp.id")
            ->leftJoin("preguntas as preg", "usu_res.id_pregunta", "=", "preg.id")
            ->where("usuarios.estatus", "Y")
            ->where("usuarios.tipo", "comun")
            ->where("resp.estatus", "Y")
            ->orderby("puntos")
            ->limit(10)
            ->get()->toArray();

        //dd($usuario);

        return view('trivia.reto.index')->with(array("usuario" => $usuario));
    }

    public function reto(Request $request){
        $trivias = Trivia::select("trivia.id",
                        "trivia.nombre",
                        "trivia.fecha_inicio",
                        "trivia.fecha_fin",
                        DB::raw("(select count(sec.id) from seccion as sec where sec.id_trivia = trivia.id and sec.estatus='Y' ) as n_secciones"),
                        DB::raw("(select count(pre.id) from preguntas as pre inner join seccion as sec on sec.id = pre.id_seccion where sec.id_trivia = trivia.id and sec.estatus='Y' and pre.estatus='Y') as n_pre")
                        )->where("trivia.estatus", "=", "Y")
                        ->groupby("trivia.id")->get()->toArray();
        //dd($trivias);

        $usuario = $request -> session() -> get('usuario');
        return view('trivia.reto.retos')->with(array("usuario" => $usuario, "trivias" => $trivias));
    }

    public function cuestionarios(Request $request, $id){
        $id = base64_decode($id);

        $usuario = $request -> session() -> get('usuario');
        $cuestionarios = Seccion::select("*",
                            DB::raw("(select count(pre.id) from preguntas as pre where pre.id_seccion = seccion.id and pre.estatus='Y') as n_pre")
                            )
                    ->where("seccion.id_trivia", "=", $id)
                    ->where("estatus", "Y")
                    ->get()->toArray();
        //dd($cuestionarios);

        //Se obtienen los cuestionarios ya respuestos
        $resueltos = UsuariosRespuestas::select("preg.id_seccion")->join("preguntas as preg", "preg.id", "=", "usuarios_respuestas.id_pregunta")
            ->where("id_usuario", $usuario['id'])->groupby("preg.id_seccion")->get()->toArray();
        $arr = [];
        foreach ($resueltos as $value) {
            $arr[] = $value["id_seccion"];
        }

        $resueltos = $arr;

        return view('trivia.reto.cuestionarios')->with(array("usuario" => $usuario, "cuestionarios" => $cuestionarios, "resueltos" => $resueltos));
    }

    
    public function preguntas(Request $request, $id_ret, $id_cuest){
        $id_ret = $id_ret;
        $id_cuestionario = base64_decode($id_cuest);

        // Se obtienen las Preguntas
        $preguntas = Preguntas::select("*")
                        ->where("preguntas.estatus","=", "Y")->where("preguntas.id_seccion", $id_cuestionario)->get()->toArray();
        //dd($preguntas);

        // Se obtienen las respuestas por pregunta
        foreach ($preguntas as $key => $value) {
            $preguntas[$key]['respuestas'] = Respuestas::select("*")->where("id_pregunta", $value["id"])->where("estatus", "Y")->get()->toArray();
        }
        //dd($preguntas);
        $usuario = $request -> session() -> get('usuario');

        return view('trivia.reto.cuestionario')->with(array("usuario" => $usuario, "preguntas" => $preguntas, "id_ret" => $id_ret));
    }


}
