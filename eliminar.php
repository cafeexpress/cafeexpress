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
		$sql = "DELETE FROM carrito WHERE id=".$_GET["idc"]." AND id_producto=".$_GET["idp"]." AND usuario='".$_GET["us"]."'";

		if ($conexion->query($sql) === TRUE) {
			header("Location: http://localhost:8080/proyecto/carrito.php");
		} else {
			echo "Error";
		}
		
		mysqli_close($conexion);
	}
?>