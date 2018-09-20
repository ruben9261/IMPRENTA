var ResetearDetalle = function(){
    $("#DescProducto").val("");
    $("#cantidad").val("0");
    $("#preciounitario").val("0");
    // $("#total").val("0");
}

var ResetearCabecera = function(){
    //$("#Codcotizacion").val("");
    $("#Descripcion").val("");
    $("#FechaCotizacion").val("");
    $("#ImporteTotal").val("0");
    $("#Igv").val("0");
    $("#IdEstado").val("0");
    $("#Importe").val("0");
}

var InicializarComponentes = function(){
    if(Reunion){
        if(Reunion.IdReunion != 0){
            $("#IdReunion").val(Reunion.IdReunion);
            $("#IdTipoEntrega").val(Reunion.IdTipoEntrega);
            $("#NombreContacto").val(Reunion.NombreContacto);
            $("#IdEstado").val(Reunion.IdEstado);
            $("#FechaVisita").val(Reunion.FechaVisita);
            $("#Observaciones").val(Reunion.Observaciones);
            $("#IdTipoInteres").val(Reunion.IdTipoInteres);
            $("#ProximaVisita").val(Reunion.ProximaVisita);
            $("#TelefonoReferencial").val(Reunion.TelefonoReferencial);
            $("#IdOrden").val(Reunion.IdOrden);
            $("#NroReunion").val(Reunion.NroReunion);
        }
    }
}


var GuardarReunion = function(){

    var Reunion = {
        IdReunion: $("#IdReunion").val(),
        IdTipoEntrega: $("#IdTipoEntrega").val(),
        NombreContacto: $("#NombreContacto").val(),
        IdEstado: $("#IdEstado").val(),
        FechaVisita: $("#FechaVisita").val(),
        Observaciones: $("#Observaciones").val(),
        IdTipoInteres: $("#IdTipoInteres").val(),
        ProximaVisita: $("#ProximaVisita").val(),
        TelefonoReferencial: $("#TelefonoReferencial").val(),
        IdOrden: $("#IdOrden").val(),
        NroReunion: $("#NroReunion").val()
    };

    $.ajax({
        type:"post",
        url:"/ReunionesController/GuardarReunion",
        data: {Reunion:Reunion},
        success: function(response){
            var response = JSON.parse(response);
            if(response.respuesta){
                $("#IdReunion").val(response.IdReunion);
                AlertNotify('', 'Exito', 'El registro se guardo correctamente', 'success');
            }else{
                AlertNotify('', 'Error', 'Ocurrio un problema al guardar los registros', 'danger');
            }
        },
        error: function(error){
            console.log(error.responseText);
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};