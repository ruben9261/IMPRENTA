<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Empleados</title>
  <link rel="stylesheet" type="text/css" href="/public/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/public/pnotify/pnotify.custom.min.css">
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Control de Clientes</a>
      </div>
    </nav>
    <div class="container">
      <div class="starter-template">
        <h1>MANTENIMIENTO - CLIENTES  <td style="text-align: center;">
            <a class="btn btn-success" href='/MainController';>
              <span class="fa fa-plus"></span>Regresar
            </a>
          </td></h1>

        <!-- <p class="lead">Aplicación Control de Ventas</p> -->
      
        <br/><br/>
       
        <button type="button" onclick="javascript: NuevoCliente();" class="btn btn-primary btn-lg" >
          <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nuevo
        </button>

        
          
           
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Usuarios</div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>NroDocumento</th>
              <th>Tipo Negocio</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Tipo Cliente</th>
            </tr>
          </thead>
          <tbody id="lista-clientes">
            

            
            <?php foreach($ListaClientes as $row){ ?>
              <tr>
                <td><?php print($row->IdCliente); ?></td>
                <td><?php print($row->razonsocial); ?></td>
                <td><?php print($row->ruc); ?></td>
                <td><?php print($row->tipo_negocio); ?></td>
                <td><?php print($row->direccion); ?></td>
                <td><?php print($row->telefono); ?></td>
                <td><?php print($row->tipo_cliente); ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Seleccione</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                      <li><a style="cursor: pointer;" onclick="javascript: EliminarCliente('<?php print($row->IdCliente); ?>');">Eliminar</a> </li>
                      <li><a style="cursor: pointer;" onclick="javascript: ObtenerCliente('<?php print($row->IdCliente); ?>');">Actualizar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php } ?>
          </tbody>
        </table>

        <div class="datagrid" id="update">
      </div>

          <div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="btn btn-danger btn-circle" onclick="javascript: CloseModal();"><i class="fa fa-times"></i>x</button>
              <h4 class="modal-title">Nuevo Usuario</h4>
          </div>

          
           <form roles="form" accion="" name="frmClientes">
             <input type="hidden" id="IdCliente" value="0">
           <div class="col-lg-12">
           
           <div class="form-group">
           <label>Razon Social</label>
           <input id="razonsocial" name="nombre" class="form-control" required>
           </div>

           <div class="form-group">
           <label>Ruc</label>
           <input id="ruc" name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Tipo de Negocio</label>
           <input id="tipo_negocio" name="NombreUsuario"  class="form-control" required>
           </div>

            <div class="form-group">
           <label>Dirección</label>
           <input id="direccion" name="PasswordUsuario"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Teléfono</label>
           <input id="telefono" name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Tipo de Cliente</label>
           <input id="tipo_cliente" name="dni"  class="form-control" required>
           </div>

           <br/>

             </div>

           </form>
            <div class="modal-footer">
              <button type="button" onclick="javascript: GuardarCliente();" class="btn btn-info btn-lg">
              <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Guardar
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script id="lista-clientes-template" type="text/x-handlebars-template">
      {{#each this.ListaClientes as |item|}}
        <tr>
                <td>{{item.IdCliente}}</td>
                <td>{{item.razonsocial}}</td>
                <td>{{item.ruc}}</td>
                <td>{{item.tipo_negocio}}</td>
                <td>{{item.direccion}}</td>
                <td>{{item.telefono}}</td>
                <td>{{item.tipo_cliente}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Seleccione</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                      <li><a style="cursor: pointer;" onclick="javascript: EliminarCliente('{{item.IdCliente}}');">Eliminar</a> </li>
                      <li><a style="cursor: pointer;" onclick="javascript: ObtenerCliente('{{item.IdCliente}}');">Actualizar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
      {{/each}}
    </script>
    <script type="text/javascript" src="/public/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/pnotify/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="/public/HandleBars/handlebars-v4.0.11.js"></script>
    <script type="text/javascript" src="/public/ImprentaJs/AlertNotifyConfiguration.js"></script>
    <script type="text/javascript" src="/public/ImprentaJs/HandlebarsConfiguration.js"></script>
    <script type="text/javascript" src="/public/ImprentaJs/Cliente/Cliente.js"></script>
  </body>
  </html>
