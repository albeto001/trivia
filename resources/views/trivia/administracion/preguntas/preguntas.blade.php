@extends('trivia.layout.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Preguntas</h1>
        <button type="button" class="btn btn-success openModal" data-toggle="modal" data-target="#myModal">
        	<span class="glyphicon glyphicon-plus"> Agregar</span>
        </button>
    </div>

</div>
<br>
<br>
<div class="row">
    <div class="col-sm-12">
    	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
            <thead>
                <tr role="row">
                	<th style="text-align: center" class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 10%;">ID</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 32%;">PREGUNTA</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 15%;">CUESTIONARIO</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">TIPO</th>
                	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">RESPUESTAS</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%;">PUNTOS</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 8%;">OPCIONES</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($preguntas as $pregunta)
                <tr class="gradeA odd" role="row" style="text-align: center">
                    <td class="center sorting_1">{{$pregunta['id']}}</td>
                    <td>{{$pregunta['pregunta']}}</td>
                    <td>{{$pregunta['seccion']}}</td>
                    <td>{{$pregunta['tipo']}}</td>
                    <td>{{$pregunta['nRespuestas']}}</td>
                    <td style="text-align:right;">{{$pregunta['maximaPuntuacion']}}</td>
                    <td style="text-align: center"> 
                    	<button type="button" id="{{$pregunta['id']}}" class="btn btn-danger elimina_preg"><span class="glyphicon glyphicon-remove"></span></button>
                    	<button data-toggle="modal" data-target="#myModal" type="button" name="{{$pregunta['id']}}" class="btn btn-success edit_preg" ><span class="glyphicon glyphicon-pencil"></span></button>
                    </td>                 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
	var cont = 0;	
	var opciones = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
	
	$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    
    $(document).on("click",".openModal", function(){
    	modal_content("/administracion/preguntas/add", "Crear Pregunta");
    });

    // Agrega las opciones al formulario
    function add_opcion(){
    	if(cont <= 25){
    		//$("button.elimina_resp").attr("disabled", "disabled");
	    	var contenido = '<tr>' +
								'<td style="text-align: center" class="opcabc"></td>' +
								'<td style="text-align: center"><input value="" type="text" name="respuesta[]" class="estado form-control requerido" placeholder="Respuesta"></td>' +
								'<td style="text-align: center"><input type="number" name="puntos[]" class="estado form-control" value="0" placeholder="0"></td>' +
								'<td style="text-align: center"><button type="button" class="btn btn-danger elimina_resp"><span class="glyphicon glyphicon-remove"></span></button></td>' +
							'</tr>';
			cont ++;
			$('table#opciones_pregunta > tbody').append(contenido);
			completaOpc();
		}


    }

    //Elimina una opcion del formulario
    $(document).on("click", "button.elimina_resp", function(){
    	if(cont >= 0){
    		$(this).parent().parent().remove();
    		cont--;
    		completaOpc();
    	}
    });

    //Agrega la letra de la opcion correspondiente
    function completaOpc(){
    	var x = 0;
    	$("table#opciones_pregunta tbody tr").each(function (index){
    		$(this).find("td.opcabc").text(opciones[x]);
    		x++;
    	});
    }

    //muestra y oculta el formulario de agregar opciones
    $(document).on("change", "select[name='tipo']", function(){
    	if($(this).val() != "A"){
    		$("div.div-opciones").show("fast");
    	}
    	else{
    		$("div.div-opciones").hide("fast");
    		$('table#opciones_pregunta > tbody').html("");
    	}
    });

    //guarda los datos del formulario
    $(document).on("click", "button#btn-acept-modal", function(){
    	if( ($("select[name='tipo']").val() != "A" && $("table#opciones_pregunta > tbody > tr").length != 0) || $("select[name='tipo']").val() == "A" ){
	    	if(valida_form_requerido($("form#new_preg"))){
	    		//Los datos estan completos
	    		var datos = new FormData($("#new_preg")[0]);
	    		$.ajax({
	                url : base_url + '/administracion/preguntas/guardar',
	                data : datos,
	                type : 'post',
	                dataType : 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
	                success : function(data) {
	                    //$("#btn-canc-modal").click();
	                    window.location.reload();  
	                 
	                },
	                error : function(xhr, status) {
	                    alert(status);
	                }
	            });

	    	}
	    }
	    else{
	    	$("table#opciones_pregunta").addClass("has-error");
	    	alert("Se requiere una o mas Opciones");
	    }

    });
    
    $(document).on("click",".edit_preg", function(){
    	var id_preg = $(this).attr("name");
    	modal_content("/administracion/preguntas/add?id="+id_preg, "Editar Pregunta");
    });

    $(document).on("click", ".elimina_preg", function(){
    	var id_preg = $(this).attr("id");
    	if(confirm("Esta seguro de eliminar la Pregunta? " + id_preg)){
    		$.ajax({
                url : base_url + '/administracion/preguntas/desactivar',
                data : {"id" : id_preg},
                type : 'get',
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
    });
</script>
@endsection
