
var ListarEmpleados = function(FiltrosEmpleado){
    $.ajax({
        type:"post",
        url:"/EmpleadosController/ListarEmpleados",
        data: {FiltrosEmpleado:FiltrosEmpleado},
        success: function(respuesta){
            var ListaEmpleados = JSON.parse(respuesta);
            var contenido = {
                ListaEmpleados: ListaEmpleados
            };
            SetHandlebars("#lista-empleados-template", contenido, "#lista-empleados");
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var ObtenerEmpleado = function(IdUsuario){
    var Usuario = {
        IdUsuario:IdUsuario
    };

    $.ajax({
        type:"post",
        url:"/EmpleadosController/ObtenerEmpleado",
        data: {Usuario:Usuario},
        success: function(respuesta){
            var Empleado = JSON.parse(respuesta);

            if(Empleado){
                if(Empleado.length > 0){
                    $("#IdUsuario").val(Empleado[0].IdUsuario);
                    $("#IdPersona").val(Empleado[0].IdPersona);
                    $("#Nombre").val(Empleado[0].Nombre);
                    $("#IdRol").val(Empleado[0].IdRol);
                    $("#Dni").val(Empleado[0].Dni);
                    $("#Cargo").val(Empleado[0].Cargo);
                    $("#Telefono").val(Empleado[0].Telefono);
                    $("#Direccion").val(Empleado[0].Direccion);
                    $("#NombreUsuario").val(Empleado[0].NombreUsuario);
                    $("#PasswordUsuario").val(Empleado[0].PasswordUsuario);

                    $("#ModalEmpleado").modal("show");
                }
            }
        },
        error: function(error){
            console.log(error.responseText);
            //AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var GuardarEmpleado = function(){

    var Empleado = {
        IdUsuario:$("#IdUsuario").val(),
        IdPersona:$("#IdPersona").val(),
        Nombre:$("#Nombre").val(),
        IdRol:$("#IdRol").val(),
        Dni:$("#Dni").val(),
        Cargo:$("#Cargo").val(),
        Telefono:$("#Telefono").val(),
        Direccion:$("#Direccion").val(),
        NombreUsuario:$("#NombreUsuario").val(),
        PasswordUsuario:$("#PasswordUsuario").val()
    };

    $.ajax({
        type:"post",
        url:"/EmpleadosController/GuardarEmpleado",
        data: {Empleado:Empleado},
        success: function(response){
            var response = JSON.parse(response);
            $("#ModalEmpleado").modal("hide");
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se guardo correctamente', 'success');
                var FiltrosEmpleado = {
                    Estado: "activo"
                };
                ListarEmpleados(FiltrosEmpleado);
            }else{
                AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
            }
        },
        error: function(error){
            $("#ModalEmpleado").modal("hide");
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};


var EliminarEmpleado = function(IdUsuario){
    var Usuario = {
        IdUsuario: IdUsuario
    };
    $.ajax({
        type:"post",
        url:"/EmpleadosController/EliminarEmpleado",
        data: {Usuario:Usuario},
        success: function(response){
            var response = JSON.parse(response);
            if(response.respuesta){
                AlertNotify('', 'Exito', 'El registro se elimo correctamente', 'success');
                var FiltrosEmpleado = {
                    Estado: "activo"
                };
                ListarEmpleados(FiltrosEmpleado);                
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

var NuevoEmpleado = function(){
    $("#IdUsuario").val("");
    $("#IdPersona").val("");
    $("#Nombre").val("");
    $("#IdRol").val("5");
    $("#Dni").val("");
    $("#Cargo").val("");
    $("#Telefono").val("");
    $("#Direccion").val("");
    $("#NombreUsuario").val(""),
    $("#PasswordUsuario").val("")

    $("#ModalEmpleado").modal("show");
}

