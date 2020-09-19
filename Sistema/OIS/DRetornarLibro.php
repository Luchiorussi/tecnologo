<?php

	include('Conexion_Prestamo.php');

	$dcodLP = $_POST['vcod'];

	$query= "  

		UPDATE detalle_prestamo
		SET estadoPrestamo_id ='2',
		Fec_Retorno = CURDATE()
		WHERE id = '$dcodLP';
	";

	$resultado = $cnmysql->query($query);

	if ($resultado) {
		include('Vlibrosprestados.php');
	}else{
		echo "<h1 style='color:#fff;'>Error al Retornar</h1>";
	}
?>