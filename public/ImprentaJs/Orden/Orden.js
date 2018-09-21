
var ListarOrdenes = function(FiltrosOrden){
    $.ajax({
        type:"post",
        url:"/OrdenController/ListarOrdenes",
        data: {FiltrosOrden:FiltrosOrden},
        success: function(respuesta){
            var ListaOrdenes= JSON.parse(respuesta);
            var contenido = {
                ListaOrdenes: ListaOrdenes
            };
            SetHandlebars("#lista-orden-template", contenido, "#lista-orden");
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var ObtenerOrden = function(IdOrden){
    var Orden = {
        IdOrden:IdOrden
    };

    $.ajax({
        type:"post",
        url:"/OrdenController/ObtenerOrden",
        data: {Orden:Orden},
        success: function(respuesta){
            var Orden = JSON.parse(respuesta);

            if(Orden){
                if(Orden.length > 0){
                    $("#IdOrden").val(Orden[0].IdOrden);
                    $("#DescripcionOrden").val(Orden[0].DescripcionOrden);
                    $("#FechaRegistro").val(Orden[0].FechaRegistro);
                    $("#IdCliente").val(Orden[0].IdCliente);
                    $("#IdUsuario").val(Orden[0].IdUsuario);

                    $("#OrdenModal").modal("show");
                }
            }
        },
        error: function(error){
            console.log(error.responseText);
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var GuardarOrden = function(){

    var Orden = {
        DescripcionOrden:$("#DescripcionOrden").val(),
        FechaRegistro:$("#FechaRegistro").val(),
        IdUsuario:$("#IdUsuario").val(),
        IdCliente:$("#IdCliente").val(),
        IdOrden:$("#IdOrden").val()
    };

    $.ajax({
        type:"post",
        url:"/OrdenController/GuardarOrden",
        data: {Orden:Orden},
        success: function(response){
            var response = JSON.parse(response);
            $("#OrdenModal").modal("hide");
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se guardo correctamente', 'success');
                var FiltrosOrden = {
                    Estado: "activo"
                };
                ListarOrdenes(null);
            }else{
                AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
            }
        },
        error: function(error){
            console.log(error.responseText);
            $("#ModalEmpleado").modal("hide");
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};


var EliminarOrden = function(IdOrden){
    var Orden = {
        IdOrden: IdOrden
    };
    $.ajax({
        type:"post",
        url:"/OrdenController/EliminarOrden",
        data: {Orden:Orden},
        success: function(response){
            var response = JSON.parse(response);
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se elimo correctamente', 'success');
                var FiltrosOrden = {
                    Estado: "activo"
                };
                ListarOrdenes(null);             
            }else{
                AlertNotify('', 'Error', 'Error al eliminar el registror', 'danger');
            }
            
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};

var CloseModal = function(){
    $("#ModalEmpleado").modal("hide");
}

var NuevaOrden = function(){
    ResetearFormulario();
    $("#OrdenModal").modal("show");
}

var ActualizarOrden = function(IdOrden){
    ResetearFormulario();
    ObtenerOrden(IdOrden);
}

var ResetearFormulario = function(){
    $("#DescripcionOrden").val("");
    $("#FechaRegistro").val("");
    $("#IdUsuario").val("0");
    $("#IdCliente").val("0");
    $("#IdOrden").val("0");
}

