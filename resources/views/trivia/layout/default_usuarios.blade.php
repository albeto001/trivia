<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Reto Injetech - @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{!! asset('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{!! asset('css/half-slider.css') !!}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{!! asset('css/sb-admin-2.css') !!}" rel="stylesheet">

     <!-- jQuery -->
    <script src="{!! asset('js/jquery-2.2.0.min.js') !!}"></script>

    <script src="{!! asset('js/jquery-ui-1.10.3.custom.min.js') !!}"></script>

    <!-- Custom Fonts -->
    <link href="{!! asset('bower_components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">

    <script src="{!! asset('js/datepicker.js') !!}"></script>
    
    <script src="{!! asset('js/funciones.js') !!}"></script>
    
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var base_public = "{!! asset('') !!}";
    </script>
    <script src="{!! asset('js/funciones.js') !!}"></script>
    @section('head')
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" href="#">Reto Injetech</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a></li>
                    <li><a class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a></li>
                    <li><a class="btn btn-social-icon btn-google"><span class="fa fa-google-plus"></span></a></li>
                    @if(!isset($usuario["id"]))
                    <li>
                        <a href="#" id="a_reg" class="openModal" data-toggle="modal" data-target="#myModal" >Registrate</a>
                    </li>
                    <li>
                        <a href="#" id="a_log" class="openModal" data-toggle="modal" data-target="#myModal">Iniciar</a>
                    </li>
                    @else
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-stats fa-fw"></i> Ranking</a>
                    </li>
                    <li>
                        <a href="{{action('reto\IndexController@reto')}}"><i class="glyphicon glyphicon-fire fa-fw"></i> Reto</a>
                    </li>
                    <li class="dropdown open">
                        <a href="{{action('usuarios\LogeoController@logout')}}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <!--<li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>-->
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{asset('images/1820x840.jpg')}}');"></div>
                <div class="carousel-caption">
                    <h2>PARTICIPA EN EL RETO</h2>
                </div>
            </div>
            <!--<div class="item"> -->
                <!-- Set the second background image using inline CSS below. -->
            <!--    <div class="fill" style="background-image:url('http://localhost/1491883106.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">-->
                <!-- Set the third background image using inline CSS below. -->
            <!--    <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>-->
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
        <!--<div class="row">
            <div class="col-lg-12">
                <h1>Half Slider by Start Bootstrap</h1>
                <p>The background images for the slider are set directly in the HTML using inline CSS. The rest of the styles for this template are contained within the <code>half-slider.css</code>file.</p>
            </div>
        </div>-->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- Modal -->
    <!--<div class="modal fade" id="modal_lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
                <div class="modal-footer">
                    <button id="btn-canc-modal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="btn-acept-modal" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="{!! asset('bower_components/bootstrap/dist/js/bootstrap.js') !!}"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 10000 //changes the speed
    })

    $(document).on("click", "#a_reg", function(){
        modal_content("/usuario/registro", "Registrate");
        $("#myModal > div > div > div.modal-footer").hide();
    });

    $(document).on("click", "#a_log", function(){
        modal_content("/logear", "Registrate");
        $("#myModal > div > div > div.modal-footer").hide();
    });
    </script>
    @if(!isset($usuario["id"]))
    <script type="text/javascript">
        
        
        $(document).on("click", "button#btn_reg", function(){
            if(valida_form_requerido($("form#form_reg"))){
                if( $("input.cpass").val()== $("input.pass").val()){
                    var datos = $("form#form_reg").serialize();
                    $.ajax({
                        url : base_url + '/usuario/guardar',
                        data : datos,
                        type : 'post',
                        dataType : 'json',
                        success : function(data) {
                          if(data.error==""){
                              //$("div#usu_creado").show("fast");
                              //$(".requerido").attr("disabled", "disabled");
                              //$('button#btn_reg').attr("disabled", "disabled");
                              //$("#id_usu_new").val(data.id_usu);
                              modal_content("/usuario/registroCompleto?usu=" + data.id_usu, "¡Ya casi estas!");
                          }
                          else{
                              $("div#mensaje_alert > div.content-alert").text(data.error);
                              $("div#mensaje_alert").show("fast");
                          }
                        },
                        error : function(xhr, status) {
                            $("div#mensaje_alert > div.content-alert").text(status);
                            $("div#mensaje_alert").show("fast");
                        }
                    });
                }
                else{
                    $("div#mensaje_alert > div.content-alert").text("La Contraseña no coinside");
                    $("div#mensaje_alert").show("fast");
                    $("input.cpass").parent().addClass("has-error");
                    $("input.pass").parent().addClass("has-error")
                }
            }
            else{
                $("div#mensaje_alert > div.content-alert").text("Los Campos marcados en rojo son obligatorios");
                $("div#mensaje_alert").show("fast");
            }
        });  

        // Reennvio de correo de verificacion
        $(document).on('click', '#usu_creado > div > a', function(){
            var id_usu = $('#id_usu_new').val();
            $.ajax({
                url : base_url + '/usuario/reenviar',
                data : {"id":id_usu},
                type : 'get',
                dataType : 'json',
                success : function(data) {
                    alert("Correo de verificacion enviado");
                },
                error : function(xhr, status) {
                    alert("status");
                }
            });
        });  
        
        $(document).on("click", "input[name='estudio_auto']", function(){
            var val = $(this).val();
            if(val == "N"){
                $("textarea[name='esc_nom']").attr("disabled", "disabled");
            }
            else{
                $("textarea[name='esc_nom']").removeAttr("disabled");
            }
            
        });
        
        $(document).on("click", "input[name='taller']", function() {
            var val = $(this).val();
            if(val == "N"){
                $("textarea[name='taller_nom']").attr("disabled", "disabled");
            }
            else{
                $("textarea[name='taller_nom']").removeAttr("disabled");
            }
        });
        
        $(document).on("change", "select[name='contacto']", function() {
            var val = $(this).val();
            if(val == "Otra"){
                $("textarea[name='otro_contacto']").removeAttr("disabled");
            }
            else{
                $("textarea[name='otro_contacto']").attr("disabled", "disabled");
            }
        });
        
        //Guardar el resto de los datos del usuario
        $(document).on("click", "#btn_regcomp", function() {
            var datos = $("form#form_reg_comp").serialize();
            $.ajax({
                url : base_url + '/usuario/guardarcompleto',
                data : datos,
                type : 'post',
                dataType : 'json',
                success : function(data) {
                  if(data.error==""){
                      $("div#usu_creado").show("fast");
                      $("div#div_inp").remove();
                      $("#id_usu_new").val(data.id_usu);
                  }
                  else{
                      $("div#mensaje_alert > div.content-alert").text(data.error);
                      $("div#mensaje_alert").show("fast");
                  }
                },
                error : function(xhr, status) {
                    $("div#mensaje_alert > div.content-alert").text(status);
                    $("div#mensaje_alert").show("fast");
                }
            });
        });
        
    </script>
    @endif


</body>

</html>