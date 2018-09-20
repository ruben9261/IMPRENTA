
var ListarClientes = function(FiltrosCliente){
    $.ajax({
        type:"post",
        url:"/ClientesController/ListarClientes",
        data: {FiltrosCliente:FiltrosCliente},
        success: function(respuesta){
            var ListaClientes = JSON.parse(respuesta);
            var contenido = {
                ListaClientes: ListaClientes
            };
            SetHandlebars("#lista-clientes-template", contenido, "#lista-clientes");
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var ObtenerCliente = function(IdCliente){
    var Cliente = {
        IdCliente:IdCliente
    };

    $.ajax({
        type:"post",
        url:"/ClientesController/ObtenerCliente",
        data: {Cliente:Cliente},
        success: function(respuesta){
            var Cliente = JSON.parse(respuesta);

            if(Cliente){
                if(Cliente.length > 0){
                    $("#IdCliente").val(Cliente[0].IdCliente);
                    $("#razonsocial").val(Cliente[0].razonsocial);
                    $("#ruc").val(Cliente[0].ruc);
                    $("#tipo_negocio").val(Cliente[0].tipo_negocio);
                    $("#direccion").val(Cliente[0].direccion);
                    $("#telefono").val(Cliente[0].telefono);
                    $("#tipo_cliente").val(Cliente[0].tipo_cliente);

                    $("#ModalCliente").modal("show");
                }
            }
        },
        error: function(error){
            // console.log(error.responseText);
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};

var GuardarCliente = function(){

    var Cliente = {
        IdCliente:$("#IdCliente").val(),
        razonsocial:$("#razonsocial").val(),
        ruc:$("#ruc").val(),
        tipo_negocio:$("#tipo_negocio").val(),
        direccion:$("#direccion").val(),
        telefono:$("#telefono").val(),
        tipo_cliente:$("#tipo_cliente").val()
    };

    $.ajax({
        type:"post",
        url:"/ClientesController/GuardarCliente",
        data: {Cliente:Cliente},
        success: function(response){
            var response = JSON.parse(response);
            $("#ModalCliente").modal("hide");
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se guardo correctamente', 'success');
                var FiltrosCliente = {
                    Estado: "activo"
                };
                ListarClientes(FiltrosCliente);
            }else{
                AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
            }
        },
        error: function(error){
            $("#ModalCliente").modal("hide");
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};


var EliminarCliente = function(IdCliente){
    var Cliente = {
        IdCliente: IdCliente
    };
    $.ajax({
        type:"post",
        url:"/ClientesController/EliminarCliente",
        data: {Cliente:Cliente},
        success: function(response){
            var response = JSON.parse(response);
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se elimo correctamente', 'success');
                var FiltrosCliente = {
                    Estado: "activo"
                };
                ListarClientes(FiltrosCliente);                
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
    $("#ModalCliente").modal("hide");
}

var NuevoCliente = function(){
    $("#IdCliente").val("");
    $("#razonsocial").val("");
    $("#ruc").val("");
    $("#tipo_negocio").val("5");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#tipo_cliente").val("");

    $("#ModalCliente").modal("show");
}

