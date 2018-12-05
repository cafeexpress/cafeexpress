<?php
	session_start();
	$nombre = $_SESSION['nombre'];
	$usuario = $_SESSION['usuario'];
	
	$server = "localhost";
	$user = "root";
	$password = "";
	$dbname = "cafeteria";

	$conexion = mysqli_connect($server, $user, $password, $dbname);
	
	$txt1 = 0;
	$txt2 = 0;
	$txt3 = 0;
	$txt4 = 0;
	$txt5 = 0;
	$txt6 = 0;
	
	if (!$conexion)
	{
		die("Error: ".mysqli_connect_error());
	}
	else
	{
		$query = "SELECT * FROM carrito WHERE usuario = '".$usuario."';";
		$resultado = mysqli_query($conexion, $query);
		
		while($r = mysqli_fetch_assoc($resultado)) {
			if ($r["id_producto"] == 1) {
				$txt1 = $r["cantidad"];
			}
			if ($r["id_producto"] == 2) {
				$txt2 = $r["cantidad"];
			}
			if ($r["id_producto"] == 3) {
				$txt3 = $r["cantidad"];
			}
			if ($r["id_producto"] == 4) {
				$txt4 = $r["cantidad"];
			}
			if ($r["id_producto"] == 5) {
				$txt5 = $r["cantidad"];
			}
			if ($r["id_producto"] == 6) {
				$txt6 = $r["cantidad"];
			}
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			function Insertar($campo, $id, $conexion, $nombre, $usuario, $txt)
			{
				$cantidad = $campo;
				
				$query = "SELECT precio FROM productos WHERE id = ".$id.";";
				$resultado = mysqli_query($conexion, $query);
				
				while($row = mysqli_fetch_assoc($resultado))
				{
					$precio = $row["precio"];
				}
				
				$total = ($cantidad * $precio);
				
				if ($txt == 0) {
					$query = "INSERT INTO carrito (id_producto, cantidad, total, usuario, nombre) VALUES (".$id.", ".$cantidad.", ".$total.", '".$usuario."', '".$nombre."');";
			
					if (mysqli_query($conexion, $query)) {
						
					}
				} else {
					$query = "UPDATE carrito SET cantidad=".$cantidad.", total=".$total." WHERE usuario = '".$usuario."' AND id_producto=".$id.";";
				
					if ($conexion->query($query) === TRUE) { 
					
					}
				}
			}

			if ($_POST["cantidad1"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad1"], 1, $conexion, $nombre, $usuario, $txt1);
			}
			
			if ($_POST["cantidad2"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad2"], 2, $conexion, $nombre, $usuario, $txt2);
			}
			
			if ($_POST["cantidad3"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad3"], 3, $conexion, $nombre, $usuario, $txt3);
			}
			
			if ($_POST["cantidad4"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad4"], 4, $conexion, $nombre, $usuario, $txt4);
			}
			
			if ($_POST["cantidad5"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad5"], 5, $conexion, $nombre, $usuario, $txt5);
			}
			
			if ($_POST["cantidad6"] != "0") {
				$exec = 'Insertar';	
				$exec($_POST["cantidad6"], 6, $conexion, $nombre, $usuario, $txt6);
			}

			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("¡Listo!","Haz agregado un producto al carrito.","success");';
			echo '}, 500);</script>';
			
			$query = "SELECT * FROM carrito WHERE usuario = '".$usuario."';";
			$resultado = mysqli_query($conexion, $query);
			
			while($r = mysqli_fetch_assoc($resultado)) {
				if ($r["id_producto"] == 1) {
					$txt1 = $r["cantidad"];
				}
				if ($r["id_producto"] == 2) {
					$txt2 = $r["cantidad"];
				}
				if ($r["id_producto"] == 3) {
					$txt3 = $r["cantidad"];
				}
				if ($r["id_producto"] == 4) {
					$txt4 = $r["cantidad"];
				}
				if ($r["id_producto"] == 5) {
					$txt5 = $r["cantidad"];
				}
				if ($r["id_producto"] == 6) {
					$txt6 = $r["cantidad"];
				}
			}
		}
		
		mysqli_close($conexion);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
		
		.panel-footer {
			background-color: rgba(255,255,255,0.1);
			color: white;
			border-color: black;
		}
		
		label, h1, h2, h3 {
			font-weight: 100;
		}
		
		.form-control {
			color: black;
			font-weight: bold;
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
				<li><a href="menu.php">Inicio</a></li>
				<li class="active"><a href="productos.php">Productos</a></li>
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
		<form method="POST" action="" >
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="120" height="120" style="margin-right: 12px; border-radius: 5px;" src="img/cafe1.png" />
						<p><span style="font-size: 22px;">Caf&eacute; en grano</span>
						<br>
						Caf&eacute; colombiano. Paquete de 1 Kg.
						<br><br>
						<span class="pull-right">$120 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad1" value="<?php echo $txt1; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="1">
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="120" height="120" style="margin-right: 12px; border-radius: 5px;" src="img/cafe2.jpg" />
						<p><span style="font-size: 22px;">Caf&eacute; tostado</span>
						<br>
						Cafe cubano tostado medio. Paquete de 1/2 Kg.
						<br><br>
						<span class="pull-right">$100 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad2" value="<?php echo $txt2; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="2">
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="120" height="120" style="margin-right: 12px; border-radius: 5px;" src="img/cafe3.jpg" />
						<p><span style="font-size: 22px;">Bombones de caf&eacute;</span>
						<br>
						Cubiertos con chocolate amargo. 20 piezas.
						<br><br>
						<span class="pull-right">$200 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad3" value="<?php echo $txt3; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="3">
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="120" height="120" style="margin-right: 12px; border-radius: 5px;" src="img/cafe4.jpg" />
						<p><span style="font-size: 22px;">Capuccino en polvo</span>
						<br>
						Caf&eacute; capuccino en polvo. Rinde 50 tazas de 200 ml.
						<br><br>
						<span class="pull-right">$230 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad4" value="<?php echo $txt4; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="4">
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="80" height="100" style="margin-right: 12px; border-radius: 5px;" src="img/cafe5.jpg" />
						<p><span style="font-size: 22px;">Kahlua</span>
						<br>
						Licor de caf&eacute; mexicano. 1 lt.
						<br><br><br>
						<span class="pull-right">$165 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad5" value="<?php echo $txt5; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="5">
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-menu">
					<div class="panel-body">
						<img class="img-responsive pull-left" width="120" height="120" style="margin-right: 12px; border-radius: 5px;" src="img/cafe6.jpg" />
						<p><span style="font-size: 22px;">Caf&eacute; molido</span>
						<br>
						Tipo americano. Paquete de 100 gr.
						<br><br>
						<span class="pull-right">$50 MXN</span>
						</p>
						<br>
						<div class="form-group pull-left">
							<label class="control-label" for="c1">Cantidad</label>
							<input type="number" class="form-control" placeholder="0" name="cantidad6" value="<?php echo $txt6; ?>" />
						</div>
						<br>
						<input type="hidden" name="id" value="6">	
						<button type="submit" class="btn btn-success pull-right" name="carrito"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Agregar</button>						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 pull-right">
				<input type="button" class="btn btn-primary pull-right" onclick="location.href='carrito.php'" value="Ir al Carrito" />
			</div>
		</div>
		</form>
	</div>
</body>
</html>