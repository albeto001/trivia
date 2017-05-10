 <form id="new_ret">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Nombre</span></span>
                <input value="{{(isset($nombre)) ? $nombre : '' }}" type="text" name="nombre" class="estado form-control requerido" placeholder="Nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span>Fecha Inicio</span></span>
                <input value="{{(isset($fecha_inicio)) ? $fecha_inicio : '' }}" type="text" name="fecha_n" class="fhecha_n form-control requerido" placeholder="YYYY/MM/DD"/>
            </div>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span>Fecha Fin</span></span>
                <input value="{{(isset($fecha_fin)) ? $fecha_fin : '' }}" type="text" name="fecha_f" class="fhecha_n form-control requerido" placeholder="YYYY/MM/DD"/>
            </div>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="input-group">
                <span class="input-group-addon"><span>Descripcion</span></span>
                <textarea name="comentario" class="form-control requerido" >{{(isset($descripcion)) ? $descripcion : '' }}</textarea>
            </div>
        </div>
    </div>
    @if(isset($id))
    <input type="hidden" name="id" value="{{$id}}">
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<script>
$(document).ready(function(){
   $("input.fhecha_n").datepicker({
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    });
});
</script>
