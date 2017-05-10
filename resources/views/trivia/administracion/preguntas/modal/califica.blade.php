<center><h3>{{$pregunta}}</h3></center>
<br><br>
<form id="form_calificacion" action="javascript:guardar()">
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
		<thead>
			<tr>
				<th width="90%">Respuesta</th>
				<th width="10%">Puntos</th>
			</tr>
		</thead>
		<tbody>
			@foreach($respuestas as $respuesta)
				<tr>
					<td>{{$respuesta['respuesta_abierta']}}</td>
					<td><input value="{{(int)$respuesta['puntos']}}" type="number" name="puntos[{{$respuesta["id"]}}]" class="estado form-control" placeholder="0"></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<input type="submit" id="send_cal" style="display: none;">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>