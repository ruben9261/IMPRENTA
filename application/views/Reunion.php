
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>
    <!-- Bootstrap -->
    <link href="/public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="/public/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
     <!-- Datatables -->
    <link href="/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/public/css/Orden/Custom.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="/public/pnotify/pnotify.custom.min.css">
  </head>

  <body class="nav-md">
    <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cotización <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> -->
                      <caption>
                        <a class="btn btn-dark" href="/OrdenController/Index">Regresar
                        <span class="glyphicon glyphicon-menu-left"></span>
                        </a>
                      </caption>                    
                      <caption>
                        <button class="btn btn-primary" onclick="javascript: GuardarCotizacion();">Guardar
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                      </caption>
                              <li class="dropdown">
                              <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              <i class="fa fa-wrench"></i>
                              </a> -->
                              <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                              </ul>
                               </li>
                                   <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                                   </li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="cabecera">
                  <div class="row">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">CodCotizacion</label>
                        <input type="email" class="form-control" id="Codcotizacion" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Descripcion</label>
                        <input type="email" class="form-control" id="Descripcion" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Estado</label>
                        <select name="" class="form-control input-sm" id="IdEstado">
                            <option value="0">--Seleccione--</option>
                            <?php foreach($ListaEstados as $row){ ?>
                                <option value="<?php print($row->IdEstado); ?>"><?php print($row->EstadoDescripcion); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">FechaCotizacion</label>
                        <input type="email" class="form-control" id="FechaCotizacion" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Importe</label>
                        <input type="email" class="form-control" id="Importe" value="0" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">IGV</label>
                        <input type="email" class="form-control" id="Igv" value="0" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Importe Total</label>
                        <input type="email" class="form-control" id="ImporteTotal" value="0" disabled>
                    </div>     
                  </div>
                  <div class="row">
                        <div class="form-group col-md-4">
                            <button class="btn btn-primary" onclick="javascript: NuevoItem();">Agregar Item</button>
                        </div>
                  </div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th style="text-align: center;">Nro Orden</th>
                          <th style="text-align: center;">Descripción</th>
                          <th style="text-align: center;">Cantidad</th>
                          <th style="text-align: center;">Precio Unitario</th>
                          <th style="text-align: center;">Total</th>
                          <th style="text-align: center;">Acciones</th>
                        </tr>
                      </thead>
                    <tbody id="lista-detallecotizacion">
                    </tbody>
                    </table>
                  </div>
                </div>
    </div>
   </div>

    <!-- MODAL PARA REGISTROS NUEVOS -->

<!-- Modal -->
<div class="modal fade" id="CotizacionDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div id="frmnuevoOrden" method="POST">
        <input type="hidden" id="IdCotizacion" value="0"></input>
        <input type="hidden" id="IdOrden" value="0"></input>
        <div class="form-group">
            <label for="exampleInputEmail1">Descripcion</label>
            <input type="email" class="form-control" id="DescProducto">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Cantidad</label>
            <input type="text" id="cantidad" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Precio Unitario</label>
            <input type="text" id="preciounitario" class="form-control input-sm">
        </div>

        <!-- <div class="form-group">
            <label for="exampleInputEmail1">Total</label>
            <input type="text" id="total" class="form-control input-sm" value="0" disabled>
        </div> -->
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnAgregarnuevo" onclick="javascript:AgregarItem();">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- HandleBars -->
    <script id="lista-detallecotizacion-template" type="text/x-handlebars-template">
      {{#each this.ListaDetalleCotizacion as |item|}}
        <tr>
                <td>{{item.IdItem}}</td>
                <td>{{item.DescProducto}}</td>
                <td>{{item.cantidad}}</td>
                <td>{{item.preciounitario}}</td>
                <td>{{Multiplicar item.cantidad item.preciounitario}}</td>
                <td style="text-align: center;">
                    <a class="btn btn-danger btn-sm" onclick="javascript: EliminarItem({{item.IdItem}});">
                    <span class="fa fa-trash"></span>
                    </a>
                </td>
        </tr>
      {{/each}}
    </script>
<!-- MODAL PARA EDITAR REGISTRO -->
    <!-- jQuery -->
    <script src="/public/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/public/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/public/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="/public/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Datatables -->
    <script src="/public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <!-- Custom Theme Scripts -->
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <!-- <script src="librerias/alertify/alertify.js"></script> -->

    <script src="/public/pnotify/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="/public/HandleBars/handlebars-v4.0.11.js"></script>
    <script type="text/javascript" src="/public/ImprentaJs/HandlebarsConfiguration.js"></script>

    <script type="text/javascript" src="/public/ImprentaJs/AlertNotifyConfiguration.js"></script>
    <script src="/public/ImprentaJs/Orden/Custom.js"></script>
    <script src="/public/ImprentaJs/Cotizacion/Cotizacion.js"></script>

    <script type="text/javascript">
      $(function() {
        $("#FechaCotizacion").datepicker({ dateFormat: 'dd/mm/yy' }).val();
      });
      
      var ListaDetalleCotizacion = <?php print json_encode($ListaDetalleCotizacion);?>;
      var Cotizacion = <?php print json_encode($Cotizacion);?>;
      InicializarComponentes();
    </script>

  </body>
</html>