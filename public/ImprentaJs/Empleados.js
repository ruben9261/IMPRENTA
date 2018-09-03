function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
			
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
	
}


function Registrar(idP, accion){
nombre = document.frmClientes.nombre.value;
dni = document.frmClientes.dni.value;
cargo = document.frmClientes.cargo.value;
telefono = document.frmClientes.telefono.value;
direccion = document.frmClientes.direccion.value;
ajax = objetoAjax();

if (accion=='N') {
ajax.open("POST", "clases/registrar.php", true);
}
if (accion=='E') {
ajax.open("POST", "clases/actualizar.php", true);
}


//OBSERVARA CUANDO NUESTRA ACCION SE HAYA REALIZADO CORRECTAMENTE MANDARA MENSAJE
ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {
		alert('Los datos fueron guardados con exito!');
		window.location.reload(true);
	}
}

//LLEGARA LA PAGINA LIMPIAMENTE
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

//la function para establecer los datos que vamos a enviar
ajax.send("nombre="+nombre+"&dni="+dni+"&cargo="+cargo+"&telefono="+telefono+"&direccion="+direccion+"&idP="+idP);

}


	function Eliminar(idP){
	if (confirm("En realidad desea eliminar este registro?")){
	ajax = objetoAjax();
	ajax.open("POST", "clases/eliminar.php", true);

	ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {
		alert('El registro fue eliminado con exito');
		window.location.reload(true);
		           			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idP="+idP);

	}else{


	}
}


//nueva lógica

var ListarEmpleados = function(){

    var FiltrosEmpleado = {};

    $.ajax({
        type:"post",
        url:"/EmpleadosController/ListarEmpleados",
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
        data: {FiltrosEmpleado:FiltrosEmpleado},
        success: function(respuesta){
            var ListaEmpleados = JSON.parse(respuesta);
            console.log(ListaEmpleados);
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
            $("#ModalEmpleado").modal("show");
        },
        error: function(error){
            console.log(error.responseText);
            //AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};



var GuardarEmpleado = function(){

    var Empleado = {};

    $.ajax({
        type:"post",
        url:"/EmpleadosController/GuardarEmpleado",
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
        data: {Empleado:Empleado},
        success: function(respuesta){
            var Empleado = JSON.parse(respuesta);
            console.log(Empleado);
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};


var EliminarEmpleado = function(){

    var IdEmpleado = 0;

    $.ajax({
        type:"post",
        url:"/EmpleadosController/EliminarEmpleado",
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
        data: {IdEmpleado:IdEmpleado},
        success: function(respuesta){
            var exito = JSON.parse(respuesta);
            console.log(exito);
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};

function AlertNotify(versionB, titulo, texto, tipo) {
    
    new PNotify({
        styling: 'bootstrap3',
        title: titulo,
        text: texto,
        type: tipo
    });
}
