<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\Usuario;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // envia un email de verificacion de correo electronico
    public function verificacion($id_us = false){
        if($id_us){
            $usuario = Usuario::find($id_us)->toArray();
            //dd($usuario);
            Mail::send('mail.verificacion', $usuario, function($msj) use ($usuario){
                $msj->subject('Verificacion de Registro');
                $msj->to($usuario['email']);
            });
        }
    }
}
