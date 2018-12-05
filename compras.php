<?php
	session_start();
	$nombre = $_SESSION['nombre'];
	$usuario = $_SESSION['usuario'];
	
	$server = "localhost";
	$user = "root";
	$password = "";
	$dbname = "cafeteria";

	$conexion = mysqli_connect($server, $user, $password, $dbname);
	
	if (!$conexion)
	{
		die("Error: ".mysqli_connect_error());
	}
	else
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			$query = "INSERT INTO compras (id_producto, cantidad, total, usuario, nombre) SELECT id_producto, cantidad, total, usuario, nombre FROM carrito WHERE usuario = '".$usuario."';";
			
			if (mysqli_query($conexion, $query)) {
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("¡Listo!","Haz realizado tu compra exitosamente.","success");';
				echo '}, 500);</script>';
			}
			
		}
		
		mysqli_close($conexion);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Compras</title>
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
				<li><a href="productos.php">Productos</a></li>
				<li><a href="carrito.php">Carrito</a></li>
				<li class="active"><a href="compras.php">Compras</a></li>
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
		<?php
			$server = "localhost";
			$user = "root";
			$password = "";
			$dbname = "cafeteria";

			$conexion = mysqli_connect($server, $user, $password, $dbname);
			
			if (!$conexion)
			{
				die("Error: ".mysqli_connect_error());
			}
			else
			{
				
				
				$query = "SELECT DISTINCT folio FROM compras WHERE usuario = '".$usuario."'";
				$resultado = mysqli_query($conexion, $query);
				
				$grantotal = 0;
				
				if (mysqli_num_rows($resultado) > 0) { ?>
				<div class="row">
					<div class="col-sm-12 pull-right">
						<h1><span class="glyphicon glyphicon-usd"></span> Compras</h1>
					</div>
				</div>
				<br>
				<?php while($row = mysqli_fetch_assoc($resultado)) { ?>
				<div class="row">
					<div class="col-sm-12">
						<h2>Folio #<?php echo $row["folio"]; ?></h2>
					</div>
					<div class="col-sm-12">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Descripcion</th>
									<th>Precio</th>
									<th>Cant.</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									$query = "SELECT C.folio AS folio, C.id AS id_compra, P.id AS id_producto, P.producto AS producto, P.descripcion AS descripcion, P.precio AS precio, C.cantidad AS cantidad, C.total AS total FROM (SELECT id, folio, id_producto, cantidad, total, usuario, nombre FROM compras) C LEFT JOIN (SELECT id, producto, descripcion, precio FROM productos) P ON C.id_producto = P.id WHERE C.usuario = '".$usuario."' AND C.folio = ".$row["folio"];
									$res = mysqli_query($conexion, $query);
									while($r = mysqli_fetch_assoc($res)) {
								?>
									<tr>
										<td><?php echo $r["producto"]; ?></td>
										<td><?php echo $r["descripcion"]; ?></td>
										<td><?php echo $r["precio"]; ?></td>
										<td><?php echo $r["cantidad"]; ?></td>
										<td><?php echo $r["total"]; ?></td>
										<?php $grantotal += $r["total"]; ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div> 
				<div class="row">
					<div class="col-sm-12">
						<p style="font-size: 20px;" class="pull-right">TOTAL: &nbsp; <?php echo "$".$grantotal; $grantotal = 0;?></p>
					</div>
				</div>
				<?php } $grantotal = 0; ?>
				<?php
				}
				else
				{
				?>
				<div class="row">
					<div class="col-sm-12 text-center">
						<br><br><br>
						<h1>Por el momento no has realizado compras.  :)</h1>
					</div>
				</div>
				<?php
				}
				
				mysqli_close($conexion);
			}
		?>
	</div>
</body>
</html>