// funcion para validar los input de un formulario ()
function valida_form_requerido(form){
    var retorno = true;
    form.find(':input').each(function() {
        if($(this).hasClass("requerido")){
            if($(this).val()==""){
                retorno = false;
                $(this).parent().addClass("has-error");
            }
        }
    });
    return retorno;
}

// serrar las notificaciones y quita la clase de error en inputs
$(document).on('click', "div.alert > button.close", function(){
    $(this).parent().hide("fast");
    $(".has-error").removeClass("has-error");
});

// agregar el contenido del modal
function modal_content(url, titulo){
    $("#myModalLabel").text(titulo);
    $("#myModal > div > div > div.modal-body").html("<center><img src='" + base_url + "/images/loading.gif'></center>");
    $.ajax({
        url : base_url + url,
        data : {},
        type : 'get',
        dataType : 'html',
        success : function(html) {
             $("#myModal > div > div > div.modal-body").html(html)
        },
        error : function(xhr, status) {
            $("#myModal > div > div > div.modal-body").html(status)
        }
    });
}

//Calendario
$(document).ready(function(){
    $("input.fhecha_n").datepicker({
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    });
});
