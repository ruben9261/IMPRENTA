<!DOCTYPE html>
<html lang="en">
<head>
	<title>VENTAS Y ALMACEN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/public/bootstrap/css/bootstrap.css">
    <script src="/public/jquery/jquery-3.2.1.min.js"></script>
    <link href="/public/css/estilo.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
	<img id="fondo" src="/public/images/ventas_fondo.jpg" />
    <span>Este es el menú</span><br/>
    <span><?php echo 'Hola '.$Usuario[0]->nombre. ' tu dni es: '.$Usuario[0]->dni ?></span>

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

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>

            
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Ventas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../operacion1/panel/form.php">Primera Visita</a></li>
              <li><a href="../operacion2/index.php">Segunda Visita</a></li>
              <li><a href="../operacion3/index.php">Tercera Visita</a></li>
              <li><a href="../operacion4/index.php">Cuarta Visita</a></li>
                            
              </ul>
          </li>

          <li><a href="/EmpleadosController/Empleados"><span class="glyphicon glyphicon-user"></span>Vendedores</a>
          </li>

          <li><a href="../datatable/index.php"><span class="glyphicon glyphicon-usd"></span>Cotizacion
          </a>
          </li> 

          <li><a href="../empresa/index.php"><span class="glyphicon glyphicon-usd"></span>Empresas
          </a>
          </li> 

        
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuario:     <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
              
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
