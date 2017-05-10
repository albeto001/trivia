@extends('trivia.layout.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Calificar Respuestas Abiertas</h1>
    </div>

</div>
<br>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
        <div class="input-group">
            <span class="input-group-addon"><span class="">Ver</span></span>
                <select id="preg_cal" class="form-control">
                    <option value="1">Sin Calificacion</option>
                    <option value="2" @if($st==1) selected @endif >Calificadas</option>
                </select>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="dataTable_wrapper">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pregunta</th>
                        <th>No. de Respuestas</th>
            			<th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($preguntas as $pregunta)
                		<tr>
                			<td style="text-align: center">{{$pregunta['id']}}</td>
                			<td>{{$pregunta['pregunta']}}</td>
                			<td style="text-align: right;">{{$pregunta['n_respuestas']}}</td>
                			<td style="text-align: center">
                				<button data-toggle="modal" data-target="#myModal" type="button" id="{{$pregunta['id']}}" class="btn btn-success calificar">
                					<span class="glyphicon glyphicon-check"></span>
                				</button>
                			</td>
                		</tr>
                	@endforeach
                </tbody>
          	</table>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

    $(document).on("click", ".calificar", function(){
    	var id_preg = $(this).attr("id");
    	modal_content("/administracion/calificar/respuestas?id="+id_preg + "&st={{$st}}", "Calificacion de Respuestas");

    });

    $(document).on("click", "#btn-acept-modal", function(){
    	$("#send_cal").click();
    });
    //envia las calificaciones
    function guardar(){
    	var datos = $("form#form_calificacion").serialize();
    	$.ajax({
            url : base_url + '/administracion/calificar/guardar',
            data : datos,
            type : 'post',
            dataType : 'json',
            success : function(data) {
                //$("#btn-canc-modal").click();
                window.location.reload();  
             
            },
            error : function(xhr, status) {
                alert(status);
            }
        });
    }
    
    $(document).on("change", "#preg_cal", function(){
        var val = Number($(this).val());

        if(val == 1){
            window.location.replace("{{action('administracion\preguntas\PreguntasController@calificar')}}");
        }
        else{
            window.location.replace("{{action('administracion\preguntas\PreguntasController@calificadas')}}");
        }
    });

</script>
@endsection