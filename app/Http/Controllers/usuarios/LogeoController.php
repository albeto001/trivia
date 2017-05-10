<?php

namespace App\Http\Controllers\usuarios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Estados;
use Socialite;
Use App\Http\Controllers\MailController;

class LogeoController extends Controller
{
    public function registro(Request $request){
        //dd($request->session()->get("usuario"));
        $estados = Estados::select("*")->orderby("nombre")->get()->toArray();
        //dd($estados);
        return view('trivia.usuarios.registro')->with(["estados" => $estados]);
    }

    public function registrocompleto(Request $request){
        return view('trivia.usuarios.registrocompleto')->with(["usuario" => $request->input("usu")]);
    } 
    
    public function nuevousuario(Request $request){
        if($request->ajax()){
            $mail = new MailController;

            $datos = $request->all();
            // se valida que el correo no este registrado
            $existe = Usuario::select('email')->where('email', 'like', trim($datos['email']))->get()->toArray();
            // si el usuario existe retorna mensaje
            if(!empty($existe)){
                return  response() -> json(['error' => 'El correo electronico '. trim($datos['email']) . ' ya existe en otra cuenta']);
            }
            $datos = array("nombre"=>$datos['nombre'], "apellido_P"=> $datos['pap'], "apellido_M" => $datos['sap'], 
                            "fecha_nacimineto" => date("Y-m-d",strtotime($datos['fecha_n'])), 
                            "login" => $datos['email'], "pass" => sha1(trim($datos['pass'])), 
                            "tipo" => 'comun', "ciudad" => $datos['ciudad'], "estado" => $datos['estado'], "email" => $datos['email'], "estatus" => 'N'
            );
            
            $usuario = Usuario::create($datos);
            $usuario = $usuario->toArray();
            if(isset($usuario['id']) && !empty($usuario['id'])){
                $request->session()->put("usuario", $usuario);

                //Envio de correo de verificacion
                //$mail -> verificacion($usuario['id']);

                return response() -> json(['error'=> "", "id_usu" => $usuario['id']]);
            }
            else{
                return response() -> json(['error'=> "error al guardar"]);
            }
            
           
        }
        
    }

    public function completarusuario(Request $request){
        if($request->ajax()){
            $id_usu = $request->input("id_usu", "");
            $estudia_auto = $request->input("estudio_auto", "");
            $esc_nom = $request->input("esc_nom", "");
            $taller = $request->input("taller", "");
            $taller_nom = $request->input("taller_nom", "");
            $contacto = $request->input("contacto", "");
            $otro_contacto = $request->input("otro_contacto","");

            $usuario = Usuario::find($id_usu);
            $usuario->refaccionaria = $taller;
            $usuario->refaccionarioa_nombre = $taller_nom;
            $usuario->estudiante = $estudia_auto;
            $usuario->escuela = $esc_nom;
            $usuario->contacto = $contacto . " " . $otro_contacto;
            $usuario->save();

            //Envio de correo de verificacion
            $mail = new MailController;
            $mail -> verificacion($id_usu);
            return response() -> json(['error'=> "", "id_usu" => $id_usu]);

        }

    }
    // Redirecciona para logear por facebook
    public function registrofacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    
    //recibe el usuario logeado por facebook
    public function loginfacebook(Request $request){
        $user = $user = Socialite::with('facebook')->user();
        $request->session()->put("usuario_social", $user);
        $user = $user->user;
        $id = $user['id'];
        $nickname = $user['email'];
        $name = explode(" ", $user['first_name'] . " " . $user['last_name']);
        $email = $user['email'];
        
        
        //se valida si exciste el usuario
        $usuario = Usuario::select('*')->where('email', 'like', trim($email))->get()->toArray();
        if(!empty($usuario)){
            $usuario = $usuario[0];
            // el usuario ya exciste
           $request->session()->put("usuario", $usuario); 
        }
        else{
            // Se registra un nuevo usuario
            $datos = array("nombre"=>$name[0], "apellido_P"=> (isset($name[1])) ? $name[1]: '', "apellido_M" => (isset($name[2])) ? $name[2]: '', "fecha_nacimineto" => date('Y/m/d'), "login" => $nickname, "pass" => sha1(trim($id)), 
                            "tipo" => 'comun', "ciudad" => '', "estado" => '', "email" => $email, "tipo_negocio" => 'social'
            );
            $usuario = Usuario::create($datos);
            $usuario = $usuario->toArray();
            $request->session()->put("usuario", $usuario); 
        }
        //dd($usuario);
        switch ($usuario['tipo']) {
            case "admin":
               return redirect('administracion/index');
            break;
            
            default:
                return redirect('reto');
            break;
        }
        //$respuesta = json_decode(redirect('form')->withInput(['nombre' => '']));
    }

    public function login(Request $request){
        if($request->ajax()){
            $usuario = Usuario::select("*") -> where("email", "like", trim($request->input("usu", "")))
                ->where("pass", sha1(trim($request->input("pass", ""))))
                ->where("estatus", 'Y')
                ->first()->toArray();
            
            $request->session()->put("usuario", $usuario); 
            return response()->json($usuario);
        }
    }

    //reenvio de correo de verificacion
    public function reenvio_verificacion(Request $request){
        if($request->ajax()){
            $mail = new MailController;
            $mail->verificacion($request->input("id"));
            return "{}";
        }
    }

    //serrar la secion
    public function logout(Request $request){
        $request->session()->flush();
         return redirect("/");

    }
}
