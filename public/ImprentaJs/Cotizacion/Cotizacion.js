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


var NuevoItem = function(){
    ResetearDetalle();
    $("#CotizacionDetalleModal").modal("show");
}

var AgregarItem = function(){

    //var ListaDetalleCotizacion = ListaDetalleCotizacion || [];
    var detalleCotizacion = {
        DescProducto: $("#DescProducto").val(),
        cantidad: $("#cantidad").val(),
        preciounitario: $("#preciounitario").val()
    }

    ListaDetalleCotizacion.push(detalleCotizacion);

    var contenido = {
        ListaDetalleCotizacion: ListaDetalleCotizacion
    };

    ActualizarDetalleCotizacion();

    SetHandlebars("#lista-detallecotizacion-template", contenido, "#lista-detallecotizacion");

    $("#CotizacionDetalleModal").modal("hide");
}

var ActualizarDetalleCotizacion = function(){
    var Importe = 0;
    var ImporteTotal = 0;
    var Igv = 0;
    if(ListaDetalleCotizacion){
        if(ListaDetalleCotizacion.length){
            $.each(ListaDetalleCotizacion,function(index, item){
                item.IdItem = index + 1;
                item.total = item.cantidad * item.preciounitario;
                Importe = Importe + item.total;
            });
            Igv = Importe * 0.18;
            ImporteTotal = Importe * 1.18;
        }
    }

    $("#Importe").val(Importe.toFixed(4));
    $("#Igv").val(Igv.toFixed(4));
    $("#ImporteTotal").val(ImporteTotal.toFixed(4));

}

function EliminarItem(IdItem){
    var Indice = null;
    if(ListaDetalleCotizacion){
        $.each(ListaDetalleCotizacion,function(index,item){
            if(item.IdItem === IdItem){
                Indice = index;
            }
        });
    }

    if(!(typeof Indice === "null")){
        ListaDetalleCotizacion.splice(Indice,1);
    }

    ActualizarDetalleCotizacion();

    var contenido = {
        ListaDetalleCotizacion: ListaDetalleCotizacion
    };

    SetHandlebars("#lista-detallecotizacion-template", contenido, "#lista-detallecotizacion");
}

var InicializarComponentes = function(){
    if(Cotizacion){
        if(Cotizacion.IdCotizacion == 0){
            $("#IdOrden").val(Cotizacion.IdOrden);
        }else{
            $("#IdCotizacion").val(Cotizacion.IdCotizacion);
            $("#IdOrden").val(Cotizacion.IdOrden);
            $("#Codcotizacion").val(Cotizacion.Codcotizacion);
            $("#Descripcion").val(Cotizacion.Descripcion);
            $("#FechaCotizacion").val(Cotizacion.FechaCotizacion);
            $("#ImporteTotal").val(Cotizacion.ImporteTotal);
            $("#Igv").val(Cotizacion.Igv);
            $("#IdEstado").val(Cotizacion.IdEstado);
            $("#Importe").val(Cotizacion.Importe);
        }
    }
    if(ListaDetalleCotizacion){
        if(ListaDetalleCotizacion.length>0){
            $.each(ListaDetalleCotizacion,function(index, item){
                item.IdItem = index + 1;
            });
            var contenido = {
                ListaDetalleCotizacion: ListaDetalleCotizacion
            };
        
            SetHandlebars("#lista-detallecotizacion-template", contenido, "#lista-detallecotizacion");
        }
    }
}


var GuardarCotizacion = function(){

    var Cotizacion = {
        IdCotizacion: $("#IdCotizacion").val(),
        IdOrden: $("#IdOrden").val(),
        Codcotizacion: $("#Codcotizacion").val(),
        Descripcion: $("#Descripcion").val(),
        FechaCotizacion: $("#FechaCotizacion").val(),
        ImporteTotal: $("#ImporteTotal").val(),
        Igv: $("#Igv").val(),
        IdEstado: $("#IdEstado").val(),
        Importe: $("#Importe").val()
    };

    Cotizacion.ListaDetalleCotizacion = ListaDetalleCotizacion || [];

    $.ajax({
        type:"post",
        url:"/CotizacionesController/GuardarCotizacion",
        data: {Cotizacion:Cotizacion},
        success: function(response){
            var response = JSON.parse(response);
            if(response.respuesta){
                $("#IdCotizacion").val(response.IdCotizacion);
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

// $(Document).ready(function(){

//     InicializarComponentes();
// });