<input type="hidden" id="id_usu_new" value="{{$usuario}}">
<form id="form_reg_comp">
	<br>
	<div class="row">
        <div id="mensaje_alert" class="alert alert-success" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="content-alert"></div>
        </div>
        <div id="usu_creado" class="alert alert-info alert-dismissable" style="display: none;">
            <div class="content-alert">Hemos enviado un correo electronico de verificacion, verifica para poder iniciar secion. <a href="javascript:" class="alert-link"> Da click para reenviar</a>.</div>
        </div>
    </div>
	<input type="hidden" name="id_usu" value="{{$usuario}}">
	<div id="div_inp"><center>
		<div class="row">
			<strong>
				¿Estas estudiando algo afín a la industria automotriz?
			</strong>
		</div>
		<div class="row">
			<label><input type="radio" name="estudio_auto" value="Y">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="estudio_auto" value="N">No</label>
		</div>
		<div class="row">
			<textarea id="esc_nom" name="esc_nom" disabled></textarea>
		</div><br>
		<div class="row">
			<strong>¿Tienes algún taller o refaccioanaria?</strong>
		</div>
		<div class="row">
			<label><input type="radio" name="taller" value="Y">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="taller" value="N">No</label>
		</div>
		<div class="row">
			<textarea id="taller_nom" name="taller_nom" disabled></textarea>
		</div><br>
		<div class="row">
			<strong>¿Cómo te enteraste del Reto Injetech?</strong>
		</div>
		<div class="row">
			<select name="contacto">
				<option value="">Seleccione Uno</option>
				<option value="Recomendacón">Recomendacón</option>
				<option value="Refaccionaria">Refaccionaria</option>
				<option value="Sucursal ciosa">Sucursal ciosa</option>
				<option value="Redes sociales">Redes sociales</option>
				<option value="Internet">Internet</option>
				<option value="Otra">Otra</option>
			</select>
		</div>
		<div class="row">
			<textarea name="otro_contacto" disabled></textarea>
		</div><br><br>
		<div class="row">
                 <button type="button" id="btn_regcomp" class="btn btn-danger btn-lg btn-block">Guardar</button>
        </div>

	</center></div>
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>