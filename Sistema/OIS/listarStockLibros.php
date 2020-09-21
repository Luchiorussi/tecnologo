<?php

include 'Conexion_Prestamo.php';

$vbusqueda = $_POST["dbusqueda"];

$query = "

	 SELECT  m.NombreMobiliario As 'Nombre del Mobiliario', m.CodigoMobiliario As 'Codigo del Mobilario',
			 a.NombreAula As 'Nombre del Aula',  em.NombreEstadoMobiliario As 'Estado Mobiliario'
	FROM mobiliarioaula As m
	INNER JOIN aula as a on a.id = m.idAula
	INNER JOIN estadomobiliario as em On em.id = m.idNombreEstadoMobiliario
	WHERE
	m.NombreMobiliario LIKE '%$vbusqueda%' OR
	m.CodigoMobiliario LIKE '%$vbusqueda%' OR
	a.NombreAula LIKE '%$vbusqueda%' OR
	em.NombreEstadoMobiliario LIKE '%$vbusqueda%'
	ORDER BY m.CodigoMobiliario DESC;

	";

$resultado = $cnmysql->query($query);

$num_filas = mysqli_num_rows($resultado);

if ($num_filas > 0) {

    echo "<style type='text/css'>

		table{
			color: #000;
			width: 100%;
			border: 1px solid #000;

		}

		table td{
			border: 1px solid #000;
			text-align: center;
			font-size: 10pt;
		}

		</style>
		";

    echo "
			<table>
				<theader>
					<tr>
						<th>Codigo del Mobiliario</th>
						<th>Nombre del Mobiliario</th>
						<th>Nombre del Aula</th>
						<th>Estado del Mobiliario</th>
					</tr>
				</theader>
				<tbody>
				<br>
		";
    while ($fila = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['Codigo del Mobilario'] . "</td>";
        echo "<td>" . $fila['Nombre del Mobiliario'] . "</td>";
        echo "<td>" . $fila['Nombre del Aula'] . "</td>";
        echo "<td>" . $fila['Estado Mobiliario'] . "</td>";

        echo "</tr>";
    }

    echo "</tbody></table>";

} else {
    echo "No Se Encontraron resultados...";
}
