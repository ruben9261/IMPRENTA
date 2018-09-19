<!DOCTYPE html>
<html lang="en">
<head>
	<title>IMPRENTA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/public/bootstrap/css/bootstrap.css">
    <link href="/public/css/estilo.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
	<img id="fondo" src="/public/images/ventas_fondo.jpg" />
    <span>Este es el menú</span><br/>

	<div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="/public/images/ventas.jpg" alt="" width="150px" height="150px"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="/MainController"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>

            
          </li>
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Ventas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../operacion1/panel/form.php">Primera Visita</a></li>
              <li><a href="../operacion2/index.php">Segunda Visita</a></li>
              <li><a href="../operacion3/index.php">Tercera Visita</a></li>
              <li><a href="../operacion4/index.php">Cuarta Visita</a></li>
                            
              </ul>
          </li> -->

          <li><a href="/EmpleadosController/Empleados"><span class="glyphicon glyphicon-user"></span> Usuarios <span class="caret"></a>
          </li>

          <li><a href="/OrdenController/Index"><span class="glyphicon glyphicon-book"></span> Ordenes <span class="caret">
          </a>
          </li> 

          <li><a href="../empresa/index.php"><span class="glyphicon glyphicon-lock"></span> Clientes <span class="caret"></span>
          </a>
          </li> 

        
          <li class="dropdown" >
            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-home"></span> Bienvenido <?php print($Usuario[0]->nombre); ?>:     <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a style="color: red" href="/LoginController/Logout"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
              
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->



  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<script type="text/javascript">
	$(window).scroll(function() {
		if ($(document).scrollTop() > 150) {
			alert('hi');
			$('.logo').height(200);

		}
		else {
			$('.logo').height(100);
		}
	});
</script>
