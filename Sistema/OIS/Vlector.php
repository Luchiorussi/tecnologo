<?php

include ('Conexion_Prestamo.php');

	$tabla = $cnmysql->query('SELECT * FROM mobiliarioaula');

	$NroLector = mysqli_num_rows($tabla);

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/hoja_lector.css">
</head>
<body>

<script type="text/javascript">
		$(function ListarDefault(){
			var parametros = {
			"dbusqueda": $("#txtbusqueda").val()
			};

			$.ajax({
			data: parametros,
			url: 'listarLector.php',
			type: 'POST',
			beforeSend: function(){
			$("#ListaLe").html("Procesando")
			},
			success: function(datos){
			$("#ListaLe").html(datos);
			}
			});


			})
		</script>


	<div id="ContenidoLe">
		
		<div id="DatosLe">
			


			<div id="tablaLe">
				
				<h1>Lista de Mobiliario de la Institución</h1>
				<div id="busqueda">


					<div id="BusquedaLe">
					<input type="text" id= "txtbusqueda" name="">
					<button type="button" onclick="ListarLector();">Buscar</button>
					
					</div>

					
				</div>

				<div id="ListaLe">
					
				</div>


				<p id="NroLectores"><?php echo "Cantidad de Mobiliario: " .$NroLector; ?></p>

			</div>


		</div>

	</div>




</body>
</html>