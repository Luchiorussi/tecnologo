<?php

include 'Conexion_Prestamo.php';

$dCodLector = $_POST['codLector'];

if (!empty($dCodLector)) {

    $query = "
		SELECT pr.idUsuario, pr.finFechaPrestamo, dp.estadoPrestamo_id FROM detalle_prestamo dp
		INNER JOIN prestamomobiliario pr ON pr.id = dp.PrestamoMobiliario_id
		WHERE pr.idUsuario = '$dCodLector' AND
		CURDATE() > pr.finFechaPrestamo AND
		dp.estadoPrestamo_id = 1;
	";

    $resultado = $cnmysql->query($query);

    $existente = mysqli_num_rows($resultado);

    if ($existente <= 0) {

        echo "<p
		style='	background-color: #8FE397;
				padding: 10px;
				box-sizing: border-box;
				color: #1D7034;
				border:2px dotted #4DA459;'
		><strong>Obsercaciones:</strong>El Lector no tiene libros pendientes </p>";
    } else {
        echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>Obsercaciones:</strong> El Lector tiene libros pendientes </p>";
    }

} else {
    echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>Error!</strong> Ingrese Carnet de Lector</p>";
}
