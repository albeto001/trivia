        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicia Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form id="form_login" role="form" method="post" action="javascript: logeo()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usu" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="pass" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Recordarme
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type='submit' value="Iniciar" class="btn btn-lg btn-success btn-block iniciar">
                                <button id="degistrar" type="button" class="btn btn-primary btn-lg btn-block">Registrar</button>
                                <a class="btn btn-block btn-social btn-facebook" href="{{url('/')}}/usuario/registro/facebook">
                                    <i class="fa fa-facebook"></i> Inicia con Facebook
                                </a>
                            </fieldset>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript">
        $(document).on("click", "#degistrar", function(){
            window.location.href = base_url + "/usuario/registro";
        });

        function logeo(){
            var datos = $('#form_login').serialize();
            $.ajax({
                url : base_url + '/log',
                data : datos,
                type : 'post',
                dataType : 'json',
                success : function(data) {
                    if(typeof(data.id) != "undefined" && data.id != ""){
                        switch(data.tipo){
                            case "admin":
                                window.location.href = base_url + "/administracion/index";
                            break;
                            default:
                                window.location.href = base_url + "/reto";
                            break;
                        }

                    }
                    else{
                        alert("Usuario y/o Contraseña incorrectos");
                    }
                },
                error : function(xhr, status) {
                    alert("Error al iniciar secion");
                }
            });
        }
    </script>
</body>

</html>