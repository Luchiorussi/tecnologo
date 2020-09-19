<?php

include 'Conexion_Prestamo.php';

$vbusqueda = $_POST["dbusqueda"];

$query = "

SELECT dp.id  As 'Codigo del Prestamo', m.NombreMobiliario As 'Nombre del Mobiliario',
a.NombreAula As 'Nombre del aula',u.NoDocumento As 'NoDocumento',
CONCAT(u.Nombre,' ',u.Apellido) As 'Usuario',pr.InicioFechaPrestamo As 'Inicio del Prestamo',
pr.finFechaPrestamo As 'Fin del Prestamo', es.Descripcion As 'Estado'
FROM detalle_prestamo dp
INNER JOIN mobiliarioaula m ON m.id = dp.MobiliarioAula_id
INNER JOIN prestamomobiliario pr ON pr.id = dp.PrestamoMobiliario_id
INNER JOIN usuario u ON u.id = pr.idUsuario
INNER JOIN estadoPrestamo es ON es.idEstadoMobiliario = dp.estadoPrestamo_id
INNER JOIN aula a ON a.id = pr.idAula
WHERE
(m.NombreMobiliario LIKE '$vbusqueda%' OR
u.NoDocumento LIKE '$vbusqueda%' OR
u.Nombre LIKE '$vbusqueda%' OR
u.Apellido LIKE '$vbusqueda%')
AND (es.idEstadoMobiliario = 1)
ORDER BY dp.id DESC;
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

		table td a{
			margin: 4px;
			display: block;
			background: #1B7A38;
			padding: 5px;
			box-sizing: border-box;
			border-radius: 5px;
		}

		table td a:hover{
			text-decoration: underline;
		}
		</style>
		";

    echo "
			<table>
				<theader>
					<tr>
						<th>Nombre del mobiliario</th>
						<th>Nombre del aula</th>
						<th>Nombre del usuario</th>
						<th>Documento</th>
						<th>Inicio Prestamo</th>
						<th>Fin Prestamo</th>
						<th>Estado del prestamo</th>
						<th colspan='2'>Operaciones</th>
					</tr>
				</theader>
				<tbody>
		";
    while ($fila = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['Nombre del Mobiliario'] . "</td>";
        echo "<td>" . $fila['Nombre del aula'] . "</td>";
        echo "<td>" . $fila['Usuario'] . "</td>";
        echo "<td>" . $fila['NoDocumento'] . "</td>";
        echo "<td>" . $fila['Inicio del Prestamo'] . "</td>";
        echo "<td>" . $fila['Fin del Prestamo'] . "</td>";
        echo "<td>" . $fila['Estado'] . "</td>";

        echo "<td>";
        echo "<a style='cursor:pointer' onclick ='VRetornarLibro(" . $fila['Codigo del Prestamo'] . ");'>Retornar</a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</tbody></table>";

} else {
    echo "No Se Encontraron resultados...";
}
