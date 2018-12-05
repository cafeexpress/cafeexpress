<?php
	$server = "localhost";
	$user = "root";
	$password = "";
	$dbname = "cafeteria";

	$conexion = mysqli_connect($server, $user, $password, $dbname);
	
	session_unset();
	
	if (!$conexion)
	{
		die("Error: ".mysqli_connect_error());
	}
	else
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$query = "SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."' AND password = '".$_POST['pass']."';";
			$resultado = mysqli_query($conexion, $query);
			
			if (mysqli_num_rows($resultado) > 0)
			{
				while($row = mysqli_fetch_assoc($resultado))
				{
					session_start();
					$_SESSION['usuario'] = $row['usuario'];
					$_SESSION['nombre'] = $row['nombre'];
					header("Location: menu.php");
				}
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("¡Upss!","Usuario no encontrado o contraseña incorrecta.","error");';
				echo '}, 500);</script>';
			}
		}
		
		mysqli_close($conexion);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesi&oacute;n</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/logincss.css"/>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
</head>
<body>
	<div class="login">  
	  <form class="login-contenido animate" action="" method="POST">
		<div class="contenedor">
			<h1>Caf&eacute;Express</h1>
			<br>
			<label for="uname">Usuario</label>
		    <input type="text" name="usuario" required>

		    <label for="psw">Contrase&ntilde;a</label>
		    <input type="password" name="pass" required>
			
		    <button class="success" type="submit">Entrar</button>
		    <button class="primary" onclick="location.href='registro.php'" >Registrarse</button>
		</div>
	  </form>
	</div>
</body>
</html>