var ResetearFormulario = function(){
    $("#DescProducto").val("");
    $("#cantidad").val("0");
    $("#preciounitario").val("0");
    // $("#total").val("0");
}


var NuevoItem = function(){
    ResetearFormulario();
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
                item.Total = item.cantidad * item.preciounitario;
                Importe = Importe + item.Total;
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