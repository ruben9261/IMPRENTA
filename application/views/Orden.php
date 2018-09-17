
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
                    <h2>Orden de Venta <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> -->

                      <caption>
                        <button class="btn btn-primary" onclick="javascript: NuevaOrden();">Nueva Orden
                        <span class="glyphicon glyphicon-plus"></span>
                        </button>
                      </caption>


                        <button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion">
                      </button>

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
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">N° Orden</th>
                          <th style="text-align: center;">Descripción</th>
                          <th style="text-align: center;">Fecha Orden</th>
                          <th style="text-align: center;">Vendedor</th>
                          <th style="text-align: center;">Empresa</th>
                          <th style="text-align: center;">Cotizacion</th>
                          <th style="text-align: center;">Etapa 1</th>
                          <th style="text-align: center;">Etapa 2</th>
                          <th style="text-align: center;">Etapa 3</th>
                          <th style="text-align: center;">Etapa 4</th>
                          <th style="text-align: center;">Acciones</th>
                        </tr>
                      </thead>
                    <tbody id="lista-orden">
                    <?php foreach($ListaOrdenes as $row){ ?>
                        <tr>
                    <td style="text-align: center;"><?php print($row->IdOrden); ?></td>
                    <td style="text-align: center;"><?php print($row->DescripcionOrden); ?></td>
                    <td style="text-align: center;"><?php print($row->razonsocial); ?></td>
                    <td style="text-align: center;"><?php print($row->FechaRegistro); ?></td>
                    <td style="text-align: center;"><?php print($row->nombre); ?></td>
                    <td style="text-align: center;">
                        <a class="btn <?php print($row->btnColor);?> btn-sm" href='/CotizacionesController/Index?IdOrden=<?php print($row->IdOrden);?>'>
                        <span class="fa fa-plus"></span><?php print($row->EstadoCotizacion);?></a>
                    </td>
                    <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden=<?php print($row->IdOrden);?>&NroRunion=1'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                     <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden=<?php print($row->IdOrden);?>&NroRunion=2'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                    <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden=<?php print($row->IdOrden);?>&NroRunion=3'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                    <td style="text-align: center;">
                        <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden=<?php print($row->IdOrden);?>&NroRunion=4'>
                        <span class="fa fa-plus">Pendiente</span>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a class="btn btn-dark btn-sm" onclick="javascript: ActualizarOrden(<?php print($row->IdOrden); ?>);">
                        <span class="fa fa-pencil"></span>
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="javascript: EliminarOrden(<?php print($row->IdOrden); ?>);">
                        <span class="fa fa-trash"></span>
                        </a>
                    </td>
                    </tr>                                    
                    <?php } ?>     
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>


        
   </div>

    <!-- MODAL PARA REGISTROS NUEVOS -->

<!-- Modal -->
<div class="modal fade" id="OrdenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div id="frmnuevoOrden" method="POST">
        <input type="hidden" id="IdOrden" value="0"></input>
        <div class="form-group">
            <label for="exampleInputEmail1">Descripcion</label>
            <input type="email" class="form-control" id="DescripcionOrden" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">FechaRegistro</label>
            <input type="text" id="FechaRegistro" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <select name="" class="form-control input-sm" id="IdUsuario">
                <option value="0">--Seleccione--</option>
                <?php foreach($ListaUsuarios as $row){ ?>
                    <option value="<?php print($row->IdUsuario); ?>"><?php print($row->Nombre); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Cliente</label>
            <select name="" class="form-control input-sm" id="IdCliente">
                <option value="0">--Seleccione--</option>
                <?php foreach($ListaClientes as $row){ ?>
                    <option value="<?php print($row->IdCliente); ?>"><?php print($row->razonsocial); ?></option>
                <?php } ?>
            </select>
        </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnAgregarnuevo" onclick="javascript:GuardarOrden();">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- HandleBars -->
    <script id="lista-orden-template" type="text/x-handlebars-template">
      {{#each this.ListaOrdenes as |item|}}
        <tr>
                <td>{{item.IdOrden}}</td>
                <td>{{item.DescripcionOrden}}</td>
                <td>{{item.razonsocial}}</td>
                <td>{{item.FechaRegistro}}</td>
                <td>{{item.nombre}}</td>
                <td style="text-align: center;">
                        <a class="btn {{item.btnColor}} btn-sm" href='/CotizacionesController/index?IdOrden={{item.IdOrden}}';>
                        <span class="fa fa-plus">{{item.EstadoCotizacion}}</span></a>
                    </td>
                    <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden={{item.IdOrden}}&NroRunion=1'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                     <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden={{item.IdOrden}}&NroRunion=2'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                    <td style="text-align: center;">
                      <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden={{item.IdOrden}}&NroRunion=3'>
                      <span class="fa fa-plus">Pendiente</span>
                      </a>
                    </td>
                    <td style="text-align: center;">
                        <a class="btn btn-success btn-sm" href='/ReunionesController/Index?IdOrden={{item.IdOrden}}&NroRunion=4'>
                        <span class="fa fa-plus">Pendiente</span>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a class="btn btn-dark btn-sm" onclick="javascript: ActualizarOrden({{item.IdOrden}});">
                        <span class="fa fa-pencil"></span>
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="javascript: EliminarOrden({{item.IdOrden}});">
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
    <script src="/public/ImprentaJs/Orden/Orden.js"></script>

    <script type="text/javascript">
    $(function() {
    $("#FechaRegistro").datepicker({ dateFormat: 'dd/mm/yy' }).val();

    $("#fecha").datepicker({ dateFormat: 'dd/mm/yy' }).val();
    $("#datepicker1").datepicker({ dateFormat: 'dd/mm/yy' }).val();
    });
    </script>



      <script type="text/javascript">      
      // $('#btnAgregarnuevo').click(function(){
      //   var datos=$('#frmnuevoOrden').serialize();
      // debugger
      // $.ajax({
      // type:"POST",
      // data:datos,
      // url:"php/registrar.php",
      // success:function(r){
      // if(r==""){
      //   $('#btnAgregarnuevo')[0].reset();
      // // $('#tablaDatatable').load('tabla.php');
      // //  $("#btncerrar").click();
      //   alertify.success("agregado con exito :D");
      // }else{
      //   alertify.error("Fallo al agregar :(");
      // }
      // }
      // });
      // });
      
      </script>

  </body>
</html>