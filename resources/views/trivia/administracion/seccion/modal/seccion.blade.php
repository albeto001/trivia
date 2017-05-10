 <form id="new_ron">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Trivia</span></span>
                <select name="id_trivia" class="form-control requerido" >
                    <option value="">Seleccione Uno</option>
                    @foreach($trivias as $trivia)
                        <option value="{{$trivia['id']}}" {{ isset($ronda['id_trivia']) && $ronda['id_trivia']== $trivia['id'] ? 'selected' : ''}}>{{$trivia['nombre']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span>Nombre</span></span>
                <input value="{{ isset($ronda['nombre']) ? $ronda['nombre'] : '' }}" type="text" name="nombre" class="form-control requerido" placeholder="Nombre"/>
            </div>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span>Fecha Inicio</span></span>
                <input value="{{ isset($ronda['fecha_inicio']) ? $ronda['fecha_inicio'] : '' }}" type="text" name="fecha_inicio" class="fhecha_n form-control requerido" placeholder="yyyy/mm/dd"/>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span>Fecha Fin</span></span>
                <input value="{{ isset($ronda['fecha_fin']) ? $ronda['fecha_fin'] : '' }}" type="text" name="fecha_fin" class="fhecha_n form-control requerido" placeholder="yyyy/mm/dd"/>
            </div>
        </div>
    </div><br>

    @if(isset($ronda['id']))
    <input type="hidden" name="id" value="{{$ronda['id']}}">
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
