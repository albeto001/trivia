@extends('trivia.layout.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retos</h1>
        <button type="button" class="btn btn-success openModal" data-toggle="modal" data-target="#myModal">
        	<span class="glyphicon glyphicon-plus"> Agregar</span>
        </button>
    </div>

</div><br>

<br>
<div class="row">
    <div class="col-sm-12">
    	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
            <thead>
                <tr role="row">
                	<th style="text-align: center" class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 10%;">ID</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%;">NOMBRE</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%;">DESCRIPCION</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 15%;">INICIO</th>
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">FIN</th>
                	<!--<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">ESTATUS</th>-->
                	<th style="text-align: center" class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">OPCIONES</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($trivias as $trivia)
                <tr class="gradeA odd" role="row" style="text-align: center">
                    <td class="center sorting_1">{{$trivia['id']}}</td>
                    <td>{{$trivia['nombre']}}</td>
                    <td>{{$trivia['descripcion']}}</td>
                    <td>{{$trivia['fecha_inicio']}}</td>
                    <td>{{$trivia['fecha_fin']}}</td>
                    <!--<td style="text-align: center">
                    @if($trivia['estatus']== 'Y')
                    	Activo
                    @else
                    	Activo
                    @endif 
                    </td>-->
                    <td style="text-align: center"> 
                    	<button type="button" id="{{$trivia['id']}}" class="btn btn-danger elimina_ret" @if($trivia['estatus']== 'N') {{"disabled"}} @endif><span class="glyphicon glyphicon-remove"></span></button>
                    	<button data-toggle="modal" data-target="#myModal" type="button" id="{{$trivia['id']}}" class="btn btn-success edit_ret" @if($trivia['estatus']== 'N') {{"disabled"}} @endif><span class="glyphicon glyphicon-pencil"></span></button>
                    </td>                 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
	
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    
    $(document).on("click",".openModal", function(){
    	modal_content("/administracion/reto/add", "Crear Reto");
    });

    $(document).on("click",".edit_ret", function(){
    	var ad = "?id="+$(this).attr("id");
    	modal_content("/administracion/reto/add" + ad, "Editar Reto");
    });

    $(document).on('click', ".elimina_ret", function(){
    	var id = $(this).attr('id');
    	if(confirm("Esta seguro de eliminar el Reto " + id)){
    		$.ajax({
    	    url : base_url + '/administracion/reto/desactivar',
    	    data : {"id" : id},
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
    
    $(document).on("click", "#btn-acept-modal", function(){
        if(valida_form_requerido($("form#new_ret"))){
            var datos = $("form#new_ret").serialize();
            $.ajax({
        	    url : base_url + '/administracion/reto/guardar',
        	    data : datos,
        	    type : 'post',
        	    dataType : 'json',
        	    success : function(data) {
        	      if(data.id){
                    $("#btn-canc-modal").click();
                    window.location.reload();  
        	           
        	      }
        	      else{
        	       alert('Error');
        	      }
        	    },
        	    error : function(xhr, status) {
        	        alert(status);
        	    }
        	});
        }
        else{
            alert("Los campos marcados en rojo son obligatorios")
        }
    
    });
</script>
@endsection