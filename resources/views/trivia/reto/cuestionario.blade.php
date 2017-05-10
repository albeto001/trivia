@extends('trivia.layout.default_usuarios')
@section('content')
<?php
	$opciones = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
?>
<br><br>
<form id="respouestas">
	@foreach($preguntas as $pregunta)
	<?php $x = 0 ?>
		<div class="row">
			<h3>{{$pregunta['pregunta']}}</h3>
		</div>
		@if($pregunta['img']!='')
		<div class="row">
			<img src="{{$pregunta['img']}}" width="1000">
		</div><br>
		@endif
		<div class="row">
			@if($pregunta['tipo'] == 'A')
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<textarea name="respuesta_a[{{$pregunta['id']}}]" rows="3" cols="100" ></textarea>
				</div>
			@else
				@foreach($pregunta['respuestas'] as $respuesta)
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		            	<label><input type="radio" name="respuesta[{{$respuesta['id_pregunta']}}]" value="{{$respuesta['id']}}" /> {{$opciones[$x]}}) {{$respuesta["respuesta"]}}</label>
					<?php $x++; ?>  
		            
		        </div>
				@endforeach

			@endif
		</div>

	@endforeach

	<div class="row">
		<button type="button" class="btn btn-primary btn-lg" id="guardad_resp">Guardar</button>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<script type="text/javascript">
	$(document).on("click", "#guardad_resp", function(){
		var datos = $("form#respouestas").serialize();
		
		if(confirm("Has resuelto todas las preguntas?")){
			$.ajax({
                url : base_url + '/reto/guardar_resp',
                data : datos,
                type : 'post',
                dataType : 'json',
                success : function(data) {
                	alert("Se guardaron tus respuestas");
                	window.location = base_url + "/reto/reto/{{$id_ret}}";
                },
                error : function(xhr, status) {
                    alert(status);
                }
            });
		}
	});
</script>
@endsection