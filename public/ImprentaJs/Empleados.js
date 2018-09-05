
var ListarEmpleados = function(FiltrosEmpleado){
    $.ajax({
        type:"post",
        url:"/EmpleadosController/ListarEmpleados",
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
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
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
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
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
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
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
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

function AlertNotify(versionB, titulo, texto, tipo) {
    
    new PNotify({
        styling: 'bootstrap3',
        title: titulo,
        text: texto,
        type: tipo
    });
}

SetHandlebars = function (idTemplate, data, idHtml) {
    if (!Handlebars.helpers.iff)
        HandlebarsRegisterHelper();

    if ($(idTemplate).length === 0 || typeof data === "undefined") {

        return false;
    }

    var source = $(idTemplate).html();
    var template = Handlebars.compile(source);
    var htmlDiv = template(data);
    idHtml = typeof idHtml === "string" ? $.trim(idHtml) : idHtml;
    if (idHtml == "" || $(idHtml).length === 0) return htmlDiv;
    $(idHtml).html(htmlDiv);
    return "";
}


HandlebarsRegisterHelper = function () {
    if (typeof (Handlebars) != "undefined") {

        Handlebars.registerHelper('if_eq', function (a, b, opts) {
            if (a == b) {
                return opts.fn(this);
            } else {
                return opts.inverse(this);
            }
        });

        Handlebars.registerHelper('iff', function (a, operator, b, opts) {
            var bool = false;
            var ret = false;

            switch (b) {
                case undefined:
                case null:
                    ret = typeof a == "boolean";
                    bool = ret ? a : false;
                    ret = true;
                    break;
                default: break;
            }

            if (ret)
                return bool ? operator.fn(this) : operator.inverse(this);


            switch (operator) {
                case '==':
                    bool = a == b;
                    break;
                case '!=':
                    bool = a != b;
                    break;
                case '>':
                    bool = a > b;
                    break;
                case '<':
                    bool = a < b;
                    break;
                case '<=':
                    bool = a <= b;
                    break;
                case '>=':
                    bool = a >= b;
                    break;
                case 'Contains':
                    bool = a.indexOf(b) >= 0;
                    break;
                case 'ContainsArray':
                    var array = (JSON.parse(b) instanceof Array) ? JSON.parse(b) : [b];
                    bool = array.Find(null, a).length > 0;
                    break;
                default:
                    throw "Unknown operator " + operator;
            }

            return bool ? opts.fn(this) : opts.inverse(this);
        });

        Handlebars.registerHelper('IsNullOrEmpty', function (a, operator, opts) {
            var bool = false;
            var optsx = opts == undefined ? operator : opts;
            operator = opts == undefined ? '==' : (operator || '==');
            opts = optsx;
            switch (operator) {
                case '==':
                    if (typeof a == "object" && a != null) {
                        if (typeof a.length != "undefined") {
                            bool = a.length == 0;
                        }
                    }
                    else {
                        bool = $.trim(a) == "";
                    }
                    break;
                case '!=':
                    if (typeof a == "object" && a != null) {
                        if (typeof a.length != "undefined") {
                            bool = a.length > 0;
                        }
                    }
                    else {
                        bool = $.trim(a) != "";
                    }
                    break;
                default:
                    throw "Unknown operator " + operator;
            }

            return bool ? opts.fn(this) : opts.inverse(this);
        });

        Handlebars.registerHelper('Replace', function (cadena, oldValue, newValue, opts) {
            cadena = cadena || "";
            cadena = cadena.ReplaceAll(oldValue, newValue);
            return new Handlebars.SafeString(cadena).string;
        });

        Handlebars.registerHelper('EscapeSpecialChars', function (textoOrigen) {
            textoOrigen = textoOrigen || "";
            textoOrigen = textoOrigen.replace(/'/g, "\\'");
            return new Handlebars.SafeString(textoOrigen);
        });

        Handlebars.registerHelper('Split', function (cadena, separador, pos, opts) {
            cadena = cadena || "";
            var listCade = cadena.split(separador);
            pos = pos || 0;
            if (pos >= 0) {
                pos = pos >= listCade.length ? listCade.length - 1 : pos < 0 ? 0 : pos;
                return new Handlebars.SafeString(listCade[pos]);
            }
            return new Handlebars.SafeString("");
        });

        Handlebars.registerHelper('Trim', function (cadena) {
            cadena = $.trim(cadena);
            return new Handlebars.SafeString(cadena);
        });

        Handlebars.registerHelper('Substr', function (length, cadena) {
            cadena = cadena || "";
            cadena = $.trim(cadena);

            if (cadena.length > length) {
                cadena = cadena.substring(0, length) + "...";
            }

            return new Handlebars.SafeString(cadena);
        });

        Handlebars.registerHelper('JSON2string', function (context) {
            return JSON.stringify(context);
        });

        Handlebars.registerHelper('UpperCase', function (context) {
            return context.toUpperCase();
        });

        Handlebars.registerHelper('DecimalToStringFormat', function (context) {
            return DecimalToStringFormat(context);
        });

        Handlebars.registerHelper('DateTimeToStringFormat', function (context) {
            if (context != null && context != '') {
                var dateString = context.substr(6);
                var currentTime = new Date(parseInt(dateString));
                var month = currentTime.getMonth() + 1;
                var day = currentTime.getDate();
                var year = currentTime.getFullYear();
                var date = (day < 10 ? "0" + day : day) + "/" + (month < 10 ? "0" + month : month) + "/" + year;
                return date;
            } else {
                return "Fomato Incorrecto";
            }
        });

        Handlebars.registerHelper('ImgSmall', function (imgOriginal) {
            var urlRender = ImgUrlRender(imgOriginal, variablesPortal.ExtensionImgSmall);
            return new Handlebars.SafeString(urlRender);
        });

        // por si en un futuro se puede utilizar
        Handlebars.registerHelper('ImgMedium', function (imgOriginal) {
            var urlRender = ImgUrlRender(imgOriginal, variablesPortal.ExtensionImgMedium);
            return new Handlebars.SafeString(urlRender);
        });

        Handlebars.registerHelper('ImgUrl', function (imgOriginal) {
            var urlRender = ImgUrlRender(imgOriginal);
            return new Handlebars.SafeString(urlRender);
        });

        Handlebars.registerHelper('SimboloMoneda', function () {
            var simbMon = variablesPortal.SimboloMoneda || "";
            return new Handlebars.SafeString(simbMon);
        });

        Handlebars.registerHelper('Multiplicar', function (a,b) {
            //var array = (JSON.parse(obj) instanceof Array) ? JSON.parse(obj) : [obj];
            //var resultado = 1;
            //$.each(array, function (index, value) {
            //    resultado = resultado * value;
            //});
            //return resultado;
            return a * b;
        });
    }
}
