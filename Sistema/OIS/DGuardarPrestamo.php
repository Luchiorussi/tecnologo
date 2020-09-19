<?php 
	include('Conexion_Prestamo.php');

	$dCodBi = $_POST['idUsuario'];	
	$dCodLector = $_POST['idUsuario'];
	$dFecDevolucion = $_POST['finFechaPrestamo'];
	$dCodLibro = $_POST['idMobiliarioaula'];

	if (!empty($dCodBi) && !empty($dCodLector) && !empty($dFecDevolucion) && !empty($dCodLibro)) 
{


	$consulta = "  
	SELECT CodigoEstado FROM prestamomobiliario 
	WHERE idMobiliarioaula = '$dCodLibro';
	";

	$result = $cnmysql->query($consulta);

	$dato = mysqli_fetch_array($result);
	$cantidad = (int) $dato['CodigoEstado'];

		if ($cantidad == 0) {
		echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>Error!: </strong>Este mobiliario no esta disponible...</p>";
		exit();
	}

		$query = " 

		INSERT INTO prestamomobiliario(idUsuario,InicioFechaPrestamo,finFechaPrestamo)
		VALUES ('$dCodBi',CURDATE(),'$dFecDevolucion');
		";

			if ($resultado) {

		$query1 = "SELECT id FROM prestamomobiliario ORDER BY id DESC LIMIT 1";
			$resultado1 = $cnmysql->query($query1);
			$dato = mysqli_fetch_array($resultado1);
			$CodPrestamo = $dato['id'];

		$query2 = "  
			INSERT INTO prestamomobiliario
			(idMobiliarioaula,id,CodigoEstado,finFechaPrestamo )
			VALUES ('$dCodLibro','$CodPrestamo','1','NULL');
		";
		$resultado2 = $cnmysql->query($query2);

		if($resultado2){
			echo "<p
		style='	background-color: #8FE397;
				padding: 10px;
				box-sizing: border-box;
				color: #1D7034;
				border:2px dotted #4DA459;'
		><strong>Éxito!: </strong> El préstamo ha sido guardado</p>";
		}else{
			echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>Error!: </strong>Los datos Presentan Errores, verifique porfavor... </p>";
		}



	}

}else{
	echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>Error!: </strong>Falta Ingresar Datos...</p>";
}



?>