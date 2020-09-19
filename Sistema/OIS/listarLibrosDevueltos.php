<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/hoja_ImprLibrosRetornados.css" media="print">
	<title></title>
</head>
<body>

</body>
</html>

<?php

include 'Conexion_Prestamo.php';

$CarnetLector = $_POST['dbusqueda'];

$query = "

SELECT dp.id AS 'Codigo prestamo', m.NombreMobiliario As 'Nombre del Mobiliario',
a.NombreAula As 'Nombre del aula',u.NoDocumento As 'NoDocumento',
CONCAT(u.Nombre,' ',u.Apellido) As 'Usuario',
pr.InicioFechaPrestamo As 'Inicio del Prestamo',
pr.finFechaPrestamo As 'Fin del Prestamo',
dp.Fec_Retorno AS 'Fecha de Retorno'
FROM detalle_prestamo dp
INNER JOIN mobiliarioaula m ON m.id = dp.MobiliarioAula_id
INNER JOIN prestamomobiliario pr ON pr.id = dp.PrestamoMobiliario_id
INNER JOIN usuario u ON u.id = pr.idUsuario
INNER JOIN estadoPrestamo es ON es.idEstadoMobiliario = dp.estadoPrestamo_id
INNER JOIN aula a ON a.id = pr.idAula
WHERE
u.NoDocumento LIKE '$CarnetLector%'
AND
es.idEstadoMobiliario = '2';

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
		table tr{
			padding: 5px;
			box-sizing: border-box;
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
						<th>Inicio Prestamo</th>
						<th>Fin Prestamo</th>
						<th>Fecha Retorno Prestamo</th>
					</tr>
				</theader>
				<tbody>
		";
    while ($fila = mysqli_fetch_array($resultado)) {
        echo "<tr height='20'>";
        echo "<td>" . $fila['Nombre del Mobiliario'] . "</td>";
        echo "<td>" . $fila['Nombre del aula'] . "</td>";
        echo "<td>" . $fila['Usuario'] . "</td>";
        echo "<td>" . $fila['Inicio del Prestamo'] . "</td>";
        echo "<td>" . $fila['Fin del Prestamo'] . "</td>";
        echo "<td>" . $fila['Fecha de Retorno'] . "</td>";

        echo "</tr>";
    }

    echo "</tbody></table>";

} else {
    echo "No Se Encontraron resultados...";
}

?>