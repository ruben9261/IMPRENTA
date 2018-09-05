<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Empleados</title>
  <link rel="stylesheet" type="text/css" href="/public/bootstrap/css/bootstrap.css">
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Control de Usuarios</a>
      </div>
    </nav>
    <div class="container">
      <div class="starter-template">
        <h1>MANTENIMIENTO - VENDEDORES  <td style="text-align: center;">
            <a class="btn btn-success" href='/MainController';>
              <span class="fa fa-plus"></span>Regresar
            </a>
          </td></h1>

        <!-- <p class="lead">Aplicación Control de Ventas</p> -->
      
        <br/><br/>
       
        <button type="button" onclick="javascript: NuevoEmpleado();" class="btn btn-primary btn-lg" >
          <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nuevo
        </button>

        
          
           
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Usuarios</div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombres</th>
              <th>Dni</th>
              <th>Cargo</th>
              <th>Telefono</th>
              <th>Dirección</th>
            </tr>
          </thead>
          <tbody id="lista-empleados">
            

            
            <?php foreach($ListaEmpleados as $row){ ?>
              <tr>
                <td><?php print($row->IdUsuario); ?></td>
                <td><?php print($row->Nombre); ?></td>
                <td><?php print($row->Dni); ?></td>
                <td><?php print($row->Cargo); ?></td>
                <td><?php print($row->Telefono); ?></td>
                <td><?php print($row->Direccion); ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Seleccione</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                      <li><a style="cursor: pointer;" onclick="javascript: EliminarEmpleado('<?php print($row->IdUsuario); ?>');">Eliminar</a> </li>
                      <li><a style="cursor: pointer;" onclick="javascript: ObtenerEmpleado('<?php print($row->IdUsuario); ?>');">Actualizar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php } ?>
          </tbody>
        </table>

        <div class="datagrid" id="update">
      </div>

          <div class="modal fade" id="ModalEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="btn btn-danger btn-circle" onclick="javascript: CloseModal();"><i class="fa fa-times"></i>x</button>
              <h4 class="modal-title">Nuevo Usuario</h4>
          </div>

          
           <form roles="form" accion="" name="frmClientes">
             <input type="hidden" id="IdUsuario" value="0">
             <input type="hidden" id="IdPersona" value="0">
           <div class="col-lg-12">
           
           <div class="form-group">
           <label>Nombre</label>
           <input id="Nombre" name="nombre" class="form-control" required>
           </div>

           <div class="form-group">
           <label>Rol</label>
           <select name="" class="selectpicker" id="IdRol">
           <?php foreach($ListaRoles as $row){ ?>
            <option value="<?php print($row->IdRol); ?>"><?php print($row->NombreRol); ?></option>
           <?php } ?>
           </select>
           </div>

           <div class="form-group">
           <label>DNI</label>
           <input id="Dni" name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>NombreUsuario</label>
           <input id="NombreUsuario" name="NombreUsuario"  class="form-control" required>
           </div>

            <div class="form-group">
           <label>PasswordUsuario</label>
           <input id="PasswordUsuario" name="PasswordUsuario"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Cargo</label>
           <input id="Cargo" name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Telefono</label>
           <input id="Telefono" name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Direccion</label>
           <input id="Direccion" name="dni"  class="form-control" required>
           </div>

           <br/>

             </div>

           </form>
            <div class="modal-footer">
              <button type="button" onclick="javascript: GuardarEmpleado();" class="btn btn-info btn-lg">
              <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Guardar
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script id="lista-empleados-template" type="text/x-handlebars-template">
      {{#each this.ListaEmpleados as |item|}}
        <tr>
                <td>{{item.IdUsuario}}</td>
                <td>{{item.Nombre}}</td>
                <td>{{item.Dni}}</td>
                <td>{{item.Cargo}}</td>
                <td>{{item.Telefono}}</td>
                <td>{{item.Direccion}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Seleccione</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                      <li><a style="cursor: pointer;" onclick="javascript: EliminarEmpleado('{{item.IdUsuario}}');">Eliminar</a> </li>
                      <li><a style="cursor: pointer;" onclick="javascript: ObtenerEmpleado('{{item.IdUsuario}}');">Actualizar</a></li>
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
    <script type="text/javascript" src="/public/ImprentaJs/Empleados.js"></script>
  </body>
  </html>
