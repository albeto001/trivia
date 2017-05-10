
    
        <form id="form_reg">
            <br>
            <div class="row"><center><h2><small>Participa en el Reto</small></h2></center></div>
            <div class="row">
                <div id="mensaje_alert" class="alert alert-success" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content-alert"></div>
                </div>
                <div id="usu_creado" class="alert alert-info alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content-alert">Hemos enviado un correo electronico de verificacion, verifica para poder iniciar secion. <a href="javascript:" class="alert-link"> Da click para reenviar</a>.</div>
                </div>
            </div>
                <div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="nombre" class="nombre form-control requerido" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="pap" class="pap form-control requerido" placeholder="Primer Apellido">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="sap" class="sap form-control requerido" placeholder="Segundo Apellido">
                    </div>
                </div>
        
            </div><br>
            <div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="date" name="fecha_n" class="fhecha_n form-control requerido" placeholder="Fecha de Nacimiento">
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
                        <input type="text" name="ciudad" class="ciudad form-control requerido" placeholder="Ciudad">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pushpin"></span></span>
                        <select name="estado" class="estado form-control requerido">
                            <option value="">Seleccione un estado</option>
                            @foreach($estados as $estado)
                            <option value="{{$estado['nombre']}}">{{$estado['nombre']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="text" name="email" class="email form-control requerido" placeholder="Correo Electrónico">
                    </div>
                </div>
        
            </div><br>
            <div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        <input type="password" name="pass" class="pass form-control requerido" placeholder="Contraseña">
                    </div>
                </div>
            </div> <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        <input type="password" name="cpass" class="cpass form-control requerido" placeholder="Confirmar Contraseña">
                    </div>
                </div>
        
            </div><br>
            <!--<div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <select name="tipon" class="tipon form-control requerido" placeholder="Tipo de negocio">
                            <option value="">Seleccione su negocio</option>
                            <option value='refaccionaria'>Refaccionaria</option>
                            <option value='taller'>Taller</option>
                            <option value='estudiante'>Estudiante</option>
                            <option value="otro">Otro</option>
                        </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   
                </div>
        
            </div>-->
            <div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    
                         <button type="button" id="btn_reg" class="btn btn-danger btn-lg btn-block">Registrar</button>
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   
                </div>
        
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>
  
    <input type="hidden" id='id_usu_new'>

    <script type="text/javascript">
        
    </script>
    