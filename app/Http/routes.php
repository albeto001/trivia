<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('verificacion/{id}', ['uses' => 'IndexController@verificacion']);

Route::get('/', ['uses' => 'IndexController@index']);
Route::get('/logear', ['uses' => 'IndexController@login']);
Route::get('/login', ['uses' => 'usuarios\LogeoController@loginfacebook']);
Route::post('/log', ['uses' => 'usuarios\LogeoController@login']);
Route::get('/logout', ['uses' => 'usuarios\LogeoController@logout']);
    //return view('trivia.index');

// Registro y logeo de usuarios
Route::group(['prefix' => 'usuario'], function () {
	Route::post('guardar',['uses' => 'usuarios\LogeoController@nuevousuario']);
	Route::post('guardarcompleto',['uses' => 'usuarios\LogeoController@completarusuario']);
    Route::get('registro',['uses' => 'usuarios\LogeoController@registro']);
    Route::get('registroCompleto',['uses' => 'usuarios\LogeoController@registrocompleto']);
    Route::get('registro/facebook',['uses' => 'usuarios\LogeoController@registrofacebook']);
    Route::get('login/facebook',['uses' => 'usuarios\LogeoController@loginfacebook']);
    Route::get('reenviar', ['uses' => 'usuarios\LogeoController@reenvio_verificacion']);
});

Route::group(['prefix' => 'administracion'], function () {
	Route::get('/index',['uses' => 'administracion\AdministracionController@index'])->name("index_admin");
	
	// TRIVIA
	Route::get('/reto',['uses' => 'administracion\reto\RetoController@index'] );
	Route::get('/reto/add',['uses' => 'administracion\reto\RetoController@add']);
	Route::post('/reto/guardar',['uses' => 'administracion\reto\RetoController@guardar']); 
	Route::get('/reto/desactivar',['uses' => 'administracion\reto\RetoController@desactivar']);
	
	//SECCION
	Route::get('/ronda',['uses' => 'administracion\seccion\SeccionController@index']);
	Route::get('/ronda/add',['uses' => 'administracion\seccion\SeccionController@add']);
	Route::post('/ronda/guardar',['uses' => 'administracion\seccion\SeccionController@guardar']);
	Route::get('/ronda/desactivar',['uses' => 'administracion\seccion\SeccionController@desactivar']);

	//Preguntas
	Route::get('/preguntas',['uses' => 'administracion\preguntas\PreguntasController@index']);
	Route::get('/preguntas/add',['uses' => 'administracion\preguntas\PreguntasController@add']);
	Route::post('/preguntas/guardar',['uses' => 'administracion\preguntas\PreguntasController@guardar']);
	Route::get('/preguntas/desactivar',['uses' => 'administracion\preguntas\PreguntasController@desactivar']);
	
	//Calificaciones
	Route::get('/calificar', ['uses' => 'administracion\preguntas\PreguntasController@calificar']);
	Route::get('/calificadas', ['uses' => 'administracion\preguntas\PreguntasController@calificadas']);
	Route::get('/calificar/respuestas', ['uses' => 'administracion\preguntas\PreguntasController@calificar_respuestas']);
	Route::post('/calificar/guardar', ['uses' => 'administracion\preguntas\PreguntasController@guardar_calificaciones']);

	//Reportes

});

Route::group(['prefix' => 'reto'], function () {
	Route::get("/", ["uses" => "reto\IndexController@index"]);
	Route::get("reto", ["uses" => "reto\IndexController@reto"]);
	Route::get("reto/{id}", ["uses" => "reto\IndexController@cuestionarios"]);
	Route::get("reto/{id_ret}/{id_cuest}", ["uses" => "reto\IndexController@preguntas"]);
	Route::post("guardar_resp", ["uses" => "reto\CuestionarioController@guardar_resp"]);
});