@extends('trivia.layout.default_usuarios')
@section('content')
<br>
<div class="row">

	@foreach($cuestionarios as $cuestionario)
	<div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                {{$cuestionario['nombre']}}
            </div>
            <div class="panel-body">
                <p><strong>Fecha de Inicio: </strong>{{$cuestionario['fecha_inicio']}}</p>
                <p><strong>Fecha de Fin: </strong>{{$cuestionario['fecha_fin']}}</p>
                <p><strong>Preguntas: </strong>{{$cuestionario['n_pre']}}</p>
            </div>
            <div class="panel-footer">
                @if(!in_array($cuestionario['id'], $resueltos))
                    <a href="{{action("reto\IndexController@reto")}}/{{base64_encode($cuestionario["id_trivia"])}}/{{base64_encode($cuestionario["id"])}}">
                        <button type="button" class="btn btn-primary btn-lg btn-block go_reto">Resolver</button>
                    </a>
                @else
                    <button type="button" class="btn btn-info btn-circle btn-xl" disabled>
                        <i class="fa fa-check"></i>
                    </button> Reto Resuelto
                @endif
            </div>
        </div>

    </div>
    @endforeach
</div>
@endsection