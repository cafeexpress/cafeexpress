<?php
	session_start();
	$nombre = $_SESSION['nombre'];
	$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu principal</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		html {
			background: url(img/menu.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			opacity: 0.9;
		}
		
		body {
			font-family: 'Segoe UI Light';
			font-size: 16px;
			background: inherit;
			color: white;
		}
		
		.navbar {
			border-radius: 0px;
		}
		
		.panel-menu {
			background-color: rgba(255,255,255,0.1);
			color: white;
		}
		
		label, h1, h2, h3 {
			font-weight: 100;
		}
		
		#panel1 {
			background-image: linear-gradient(rgba(0,0,0,0.6) 100%, rgba(0,0,0,0.6) 100%), url(img/panel1.jpg);
			background-size: cover; 
			background-position: center; 
			background-repeat: no-repeat; 
			border-color: black;
		}
		
		#panel2 {
			background-image: linear-gradient(rgba(0,0,0,0.6) 100%, rgba(0,0,0,0.6) 100%), url(img/panel2.jpg);
			background-size: cover; 
			background-position: center; 
			background-repeat: no-repeat; 
			border-color: black;
		}
		
		#panel3 {
			background-image: linear-gradient(rgba(0,0,0,0.6) 100%, rgba(0,0,0,0.6) 100%), url(img/panel3.jpg);
			background-size: cover; 
			background-position: center; 
			background-repeat: no-repeat; 
			border-color: black;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" style="color: white;" href="#">Caf&eacute;Express</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="menu.php">Inicio</a></li>
				<li><a href="productos.php">Productos</a></li>
				<li><a href="carrito.php">Carrito</a></li>
				<li><a href="compras.php">Compras</a></li>
			  </ul>

			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i>&nbsp; <?php echo $nombre;?><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="login.php"><i class="glyphicon glyphicon-off"></i>&nbsp; Salir</a></li>
				  </ul>
				</li>
			  </ul>
			</div>
		</div>
	</nav>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1>Bienvenido a Caf&eacute;Express</h1>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-sm-4">
				<div id="panel1" class="panel panel-menu">
					<div class="panel-heading">
						<h2>Relajate!</h2>
					</div>
					<div class="panel-body text-justify">
						<br>
						<h3>Date un momento de gusto para disfrutar del mejor caf&eacute; de la ciudad.</h3>
						<br><br><br><br>
						<a class="pull-right" style="color: transparent; font-size: 17px;" href="compras.php">aa</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div id="panel2" class="panel panel-menu">
					<div class="panel-heading">
						<h2>Conoce nuestros productos</h2>
					</div>
					<div class="panel-body text-justify">
						<h3>Nuestro caf&eacute; es de la m&aacute;s alta calidad, con un gran aroma y sabor que deleita hasta los paladares mas exigentes.</h3>
						<br><br>
						<a class="pull-right" style="color: white; font-size: 17px;" href="productos.php">Conoce m&aacute;s</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div id="panel3" class="panel panel-menu">
					<div class="panel-heading">
						<h2>Sigue tus compras de cerca</h2>
					</div>
					<div class="panel-body text-justify">
						<br>
						<h3>Te ofrecemos un listado de tus compras realizadas en nuestra tienda.</h3>
						<br><br>
						<a class="pull-right" style="color: white; font-size: 17px;" href="compras.php">Ver mis compras</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>