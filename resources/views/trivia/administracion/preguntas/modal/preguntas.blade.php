<?php 
    $opc = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $x=0;
?>
<form id="new_preg" role="form" enctype="multipart/form-data">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Cuestionario</span></span>
                <select name="id_seccion" class="form-control requerido" >
                    <option value="">Seleccione Uno</option>
                    @foreach($cuestionarios as $cuestionario)
                        <option value="{{$cuestionario['id']}}" @if(isset($pregunta['id_seccion']) && $cuestionario['id'] == $pregunta['id_seccion']) selected @endif >{{$cuestionario['nombre']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Tipo</span></span>
                <select name="tipo" class="form-control requerido" >
                    <option value="O" @if(isset($pregunta['tipo']) && $pregunta['tipo'] == "O") selected @endif >Opcional</option>
                    <option value="A" @if(isset($pregunta['tipo']) && $pregunta['tipo'] == "A") selected @endif >Abierta</option>
                </select>
            </div>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Pregunta</span></span>
                <textarea name="pregunta" class="form-control requerido" >@if(isset($pregunta['pregunta'])) {{$pregunta['pregunta']}} @endif</textarea>
            </div>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="input-group">
                <span class="input-group-addon"><span class="">Imagen</span></span>
                <input name="img" class="form-control" type="file" accept="image/*" value="@if(isset($pregunta['img'])) {{$pregunta['img']}} @endif" />
            </div>
        </div>
    </div><br><br>
    <div class="div-opciones" @if(isset($pregunta['tipo']) && $pregunta['tipo'] == "A") style="display: none;" @endif>
        <div class="row adopciones">
            <div class="col-lg-12">
                <button type="button" onclick="add_opcion()" class="btn btn-success add_opcion">
                    <span class="glyphicon glyphicon-plus"> Opciones</span>
                </button>
            </div>
        </div><br>
        <div class="row">
            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="opciones_pregunta">
                <thead>
                    <tr>
                        <th width="10%">Opcion</th>
                        <th width="72%">Respuesta</th>
                        <th width="10%">Puntuacion</th>
                        <th width="8%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($respuestas as $respuesta)
                        <tr>
                            <td style="text-align: center" class="opcabc">{{$opc[$x]}}</td>
                            <td style="text-align: center"><input value="{{$respuesta['respuesta']}}" type="text" name="respuesta_ex[{{$respuesta['id']}}]" class="estado form-control requerido" placeholder="Respuesta"></td>
                            <td style="text-align: center"><input value="{{$respuesta['puntuacion1']}}" type="number" name="puntos_ex[{{$respuesta['id']}}]" class="estado form-control" placeholder="0"></td>
                            <td style="text-align: center"><button type="button" class="btn btn-danger elimina_resp"><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                    <!--<tr>
                        <td style="text-align: center" class="opcabc">a</td>
                        <td style="text-align: center"><input value="" type="text" name="respuesta[]" class="estado form-control requerido" placeholder="Respuesta"></td>
                        <td style="text-align: center"><input type="number" name="puntos[]" class="estado form-control" value="0" placeholder="0"></td>
                        <td style="text-align: center"><button type="button" class="btn btn-danger elimina_resp"><span class="glyphicon glyphicon-remove"></span></button></td>
                    </tr>-->
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($pregunta['id']))
    <input type="hidden" name="id" value="{{$pregunta['id']}}">
    @endif
</form>
<script type="text/javascript">
    cont = {{$x}};
</script>