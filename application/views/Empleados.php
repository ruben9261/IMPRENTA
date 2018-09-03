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
        <a class="navbar-brand" href="#">Control de Vendedores</a>
      </div>
    </nav>
    <div class="container">
      <div class="starter-template">
        <h1>MANTENIMIENTO - VENDEDORES  <td style="text-align: center;">
            <a class="btn btn-success" href='/MainController';>
              <span class="fa fa-plus"></span>Regresar
            </a>
          </td></h1>

        <p class="lead">Aplicación Control de Ventas</p>
      
               
       
        <button type="button" onclick="Nuevo();" class="btn btn-primary btn-lg" >
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
          <tbody>
            

            
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
              <button type="button" class="close" data-dismiss="ModalEmpleado" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Nuevo Usuario</h4>
          </div>

          
           <form roles="form" accion="" name="frmClientes">
           <div class="col-lg-12">
           
           <div class="form-group">
           <label>Nombre</label>
           <input id="Nombre" name="nombre" class="form-control" required>
           </div>

           <div class="form-group">
           <label>Rol</label>
           <select name="" class="selectpicker" id="IdRol">
             <option value="5">Admin</option>
             <option value="6">Empleado</option>
           </select>
           </div>

            <div class="form-group">
           <label>DNI</label>
           <input id="Dni" name="dni"  class="form-control" required>
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

           <br />

            <button type="button" onclick="javascript: GuardarEmpleado();" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Guardar
            </button>

             </div>

           </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="ModalEmpleado"><i class="fa fa-times"></i>x</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <script type="text/javascript" src="/public/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/ImprentaJs/Empleados.js"></script>
  </body>
  </html>