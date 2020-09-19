<?php

	include('Conexion_Prestamo.php');

	$vbusqueda = $_POST["dbusqueda"];

	$query= "

		SELECT  u.Nombre, u.Apellido, cg.NombreCargo, td.NombreTipoDocumento,
		u.NoDocumento,u.CorreoElectronico
		FROM usuario u
		INNER JOIN tipodocumento td On td.id = u.idTipoDocumento
		INNER JOIN cargousuario cg on cg.NivelVisibilidad=u.idCargoUsuario
		WHERE  (NoDocumento LIKE '%$vbusqueda%' OR Nombre LIKE '%$vbusqueda%' OR Apellido LIKE '%$vbusqueda%')
		AND (u.idCargoUsuario ='1')
		ORDER BY u.NoDocumento;
        
	";


	$resultado = $cnmysql->query($query);

	$num_filas = mysqli_fetch_array($resultado);

	if ($num_filas > 0) {
		echo "<style type='text/css'>

		table{
			color: #fff;
			width: 100%;
			border: 1px solid #fff;
		}

		table td{
			border: 1px solid #fff;
			text-align: center;
		}

		</style>
		";

		echo "   
			<table>
				<theader>
					<tr>			
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Cargo</th>
						<th>Tipo del Documento</th>
						<th>NoDocumento</th>
						<th>Correo Electronico</th>
					</tr>
				</theader>
				<tbody>
				<br>
		";
		while ($fila = mysqli_fetch_array($resultado)) {
			echo "<tr>";
				echo "<td>" .$fila['Nombre'] ."</td>";
				echo "<td>" .$fila['Apellido'] ."</td>";
				echo "<td>" .$fila['NombreCargo'] ."</td>";
				echo "<td>" .$fila['NombreTipoDocumento'] ."</td>";
				echo "<td>" .$fila['NoDocumento'] ."</td>";
				echo "<td>" .$fila['CorreoElectronico'] ."</td>";
			echo "</tr>";
		}

		echo "</tbody></table>";


	}else{
		echo "No Se Encontraron resultados...";
	}


?>