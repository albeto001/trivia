<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use Socialite;

class IndexController extends Controller
{
    public function index(Request $request){
    	//dd($request->session()->all());
        return view('trivia.index');
    }

    public function verificacion(Request $request, $id){
    	$id = base64_decode($id);
    	$usuario = Usuario::find($id);
    	$usuario->estatus = "Y";
    	$usuario->save();
    	$usuario = $usuario->toArray();

    	$request->session()->put("usuario", $usuario); 

    	switch ($usuario['tipo']) {
            case "admin":
               return redirect('administracion/index');
            break;
            case 'comun':
            	return redirect('reto');
            break;
            
            default:
                return redirect('/');
            break;
        }


    }

    public function login(){
        return view('trivia.login');
    }
}