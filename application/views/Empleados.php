<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD AJAX+PHP+MYSQL</title>
  <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="/public/js/ajax.js"></script>
 
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
            <a class="btn btn-success" href='../vistas/inicio.php';>
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
            

            
            <?php
            require("clases/conexion1.php");
            $con = Conectar();
            $sql = "SELECT idpersonas, nombre, dni, cargo, telefono, direccion FROM personas";
            $stmt = $con->prepare($sql);
            $result = $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach($rows as $row){
              ?>
              <tr>
                <td><?php print($row->idpersonas); ?></td>
                <td><?php print($row->nombre); ?></td>
                <td><?php print($row->dni); ?></td>
                <td><?php print($row->cargo); ?></td>
                <td><?php print($row->telefono); ?></td>
                <td><?php print($row->direccion); ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Seleccione</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                      <li><a style="cursor: pointer;" onclick="Eliminar('<?php print($row->id); ?>');">Eliminar</a> </li>
                      <li><a style="cursor: pointer;" onclick="Editar('<?php print($row->idpersonas); ?>' ,'<?php print($row->nombre); ?>','<?php print($row->dni); ?>','<?php print($row->cargo); ?>','<?php print($row->telefono); ?>','<?php print($row->direccion); ?>' );">Actualizar</a></li>
                    </ul>

                  
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

        <div class="datagrid" id="update">
      </div>

          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Nuevo Usuario</h4>
          </div>

          
           <form roles="form" accion="" name="frmClientes" onsubmit="Registrar(idP, accion); return false">
           <div class="col-lg-12">
           
           <div class="form-group">
           <label>Nombre</label>
           <input name="nombre" class="form-control" required>
           </div>

            <div class="form-group">
           <label>DNI</label>
           <input name="dni"  class="form-control" required>
           </div>

           <div class="form-group">
           <label>Cargo</label>
           <input name="cargo" class="form-control" required>
           </div>

           <div class="form-group">
           <label>Telefono</label>
           <input name="telefono" class="form-control" required>
           </div>

           <div class="form-group">
           <label>Direccion</label>
           <input name="direccion" class="form-control" required="">
          </div>

           <br />

            <button type="submit" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Registrar
            </button>

             </div>

           </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i>x</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    
    var accion;
    var idP;
    function Nuevo(){
    accion = 'N';
    document.frmClientes.nombre.value = "";
    document.frmClientes.dni.value = "";
    document.frmClientes.cargo.value = "";
    document.frmClientes.telefono.value = "";
    document.frmClientes.direccion.value = "";
    $('#modal').modal('show');
    }

    function Editar(id, nombre, dni, cargo, telefono, direccion){
    accion= 'E';
    idP=id;
    document.frmClientes.nombre.value = nombre;
    document.frmClientes.dni.value = dni;
    document.frmClientes.cargo.value = cargo;
    document.frmClientes.telefono.value = telefono;
    document.frmClientes.direccion.value = direccion;
    $('#modal').modal('show')
    }

    function b(){
      alert('accion ' + accion)
    }


    </script>
  
  </body>
  </html>
