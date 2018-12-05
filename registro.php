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
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$query = "SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."';";
			$resultado = mysqli_query($conexion, $query);
			
			if (mysqli_num_rows($resultado) == 0)
			{
				$query = "INSERT INTO usuarios (nombre, ciudad, usuario, password) VALUES ('".$_POST["nombre"]."', '".$_POST["ciudad"]."', '".$_POST["usuario"]."', '".$_POST["pass"]."');";
			
				if (mysqli_query($conexion, $query))
				{
					echo '<script type="text/javascript">';
					echo 'setTimeout(function () { swal("¡Listo!","Usuario registrado correctamente.","success");';
					echo '}, 500);</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("¡Upss!","Usuario ya registrado, intenta con otro.","error");';
				echo '}, 500);</script>';
			}
		}
		
		mysqli_close($conexion);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrar</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/logincss.css"/>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<div class="login">  
	  <form id="form1" class="login-contenido animate" action="" method="POST" style="margin-top: 0px;">
		<div class="contenedor">
			<h1>Crear Usuario</h1>
			<br>
			<label for="uname">Nombre</label>
		    <input type="text" name="nombre" required>

			<label for="uname">Ciudad</label>
		    <input type="text" name="ciudad" required>
			
			<label for="uname">Usuario</label>
		    <input type="text" name="usuario" required>
			
		    <label for="psw">Contrase&ntilde;a</label>
		    <input type="password" name="pass" required>
			<br><br>
			
		    <button class="primary" type="submit">&#161;Listo&#33;</button>
			<button class="danger" onclick="location.href='login.php'">Regresar</button>
		</div>
	  </form>
	</div>
</body>
</html>