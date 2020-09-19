
<?php

include ('Conexion_Prestamo.php');

	$vbusqueda = $_POST["dbusqueda"];


		$query= "

		SELECT a.id As 'Codigo del Aula', a.NombreAula As 'Nombre del Aula', a.EstadoAula As 'Estado del Aula'
		FROM aula As a
		WHERE a.id like '$vbusqueda%' OR
		a.NombreAula like '$vbusqueda%' 
		ORDER BY a.id ASC;
		"
;





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
						<th>Codigo</th>
						<th>Nombre del aula</th>
						<th>Estado del aula</th>

					</tr>
				</theader>
				<tbody>
		";



		while ($fila = mysqli_fetch_array($resultado)) {
			echo "<tr>";
				echo "<td>" .$fila['Codigo del Aula'] ."</td>";
				echo "<td>" .$fila['Nombre del Aula'] ."</td>";

?>

               <td class="text-center">
                 <?php if ($fila['Estado del Aula'] === '1'): ?>
            <span class="label label-success"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
               </td>


<?php

			echo "</tr>";
		}

		echo "</tbody></table>";


	}else{
		echo "No Se Encontraron resultados... en la lista de Aulas";
	}


?>




