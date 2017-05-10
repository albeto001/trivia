@extends('trivia.layout.default_usuarios')
@section('content')
<br>
<div class="row">

	@foreach($trivias as $trivia)
	<div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                {{$trivia['nombre']}}
            </div>
            <div class="panel-body">
                <p><strong>Fecha de Inicio: </strong>{{$trivia['fecha_inicio']}}</p>
                <p><strong>Fecha de Fin: </strong>{{$trivia['fecha_fin']}}</p>
                <p><strong>Cuestionarios: </strong>{{$trivia['n_secciones']}}</p>
                <p><strong>Preguntas: </strong>{{$trivia['n_pre']}}</p>
            </div>
            <div class="panel-footer">
               <a href="{{action("reto\IndexController@reto")}}/{{base64_encode($trivia["id"])}}"><button type="button" class="btn btn-primary btn-lg btn-block go_reto" id="{{base64_encode($trivia["id"])}}">Acepta el Reto</button></a>
            </div>
        </div>

    </div>
    @endforeach

</div>
@endsection