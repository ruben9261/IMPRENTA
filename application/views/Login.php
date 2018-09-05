<!DOCTYPE html>
<html>
<head>
      <title>Login de usuario</title>
      <link rel="stylesheet" type="text/css" href="/public/bootstrap/css/bootstrap.css">      
      <link rel="stylesheet" type="text/css" href="/public/pnotify/pnotify.custom.min.css">
</head>
<body style="background-color: gray">
      <br><br><br>
      <div class="container">
            <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                        <div class="panel panel-primary">
                              <div class="panel panel-heading">Sistema de ventas y almacen</div>
                              <div class="panel panel-body">
                                    <p>
                                          <img src="/public/images/ventas.jpg"  height="190">
                                    </p>
                                    <form id="frmLogin">
                                          <label>Usuario</label>
                                          <input type="text" class="form-control input-sm" name="usuario" id="NombreUsuario">
                                          <label>Password</label>
                                          <input type="password" name="password" id="PasswordUsuario" class="form-control input-sm">
                                          <p></p>
                                          <span class="btn btn-primary btn-sm" onclick="javascript: Login();">Entrar</span>
                                          <a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
                                    </form>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-4"></div>
            </div>
      </div>
      <script src="/public/jquery/jquery-3.2.1.min.js"></script>
      <script src="/public/pnotify/pnotify.custom.min.js"></script>
      <script src="/public/ImprentaJs/Login.js"></script>
      

</body>
</html>

