
<?php

include ('Conexion_Prestamo.php');

	$vbusqueda = $_POST["dbusqueda"];


	$query= "

SELECT m.id As 'id del Mobiliario', m.NombreMobiliario As 'Nombre del Mobiliario' ,
m.CodigoMobiliario As 'Codigo del Mobiliario',a.NombreAula As 'Nombre Aula', 
m.VidaUtilMobiliario As 'Vida Util Inicial',
m.VidaUtilMobiliarioFinal As 'Vida Util Final',
em.NombreEstadoMobiliario As 'Estado Mobiliario'
FROM mobiliarioaula As m
INNER JOIN aula AS a ON a.id = m.idAula 
INNER JOIN estadomobiliario em ON em.id = m.idNombreEstadoMobiliario
WHERE m.NombreMobiliario LIKE '$vbusqueda%' OR
m.NombreMobiliario LIKE '$vbusqueda%' OR
m.CodigoMobiliario LIKE '$vbusqueda%' OR 
a.NombreAula LIKE '$vbusqueda%' OR
em.NombreEstadoMobiliario LIKE '$vbusqueda%' 
ORDER BY m.id

	 ";

	$resultado = $cnmysql->query($query);

	$num_filas = mysqli_num_rows($resultado);

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
						<th>Id Mobiliario</th>
						<th>Nombre del Mobiliario</th>
						<th>Codigo del Mobiliario</th>
						<th>Nombre del Aula</th>
						<th>Vida Util Inicial Mobiliario</th>
						<th>Vida Util Final Mobiliario</th>
						<th>Estado Mobiliario</th>
					</tr>
				</theader>
				<tbody>
		";
		while ($fila = mysqli_fetch_array($resultado)) {
			echo "<tr>";
				echo "<td>" .$fila['id del Mobiliario'] ."</td>";
				echo "<td>" .$fila['Nombre del Mobiliario'] ."</td>";
				echo "<td>" .$fila['Codigo del Mobiliario'] ."</td>";
				echo "<td>" .$fila['Nombre Aula'] ."</td>";
				echo "<td>" .$fila['Vida Util Inicial'] ."</td>";
				echo "<td>" .$fila['Vida Util Final'] ."</td>";
				echo "<td>" .$fila['Estado Mobiliario'] ."</td>";




			echo "</tr>";
		}

		echo "</tbody></table>";


	}else{
		echo "No Se Encontraron resultados...";
	}


?>