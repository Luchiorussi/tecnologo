<?php

	include('Conexion_Prestamo.php');

	$tabla = $cnmysql->query('SELECT * FROM usuario WHERE idCargoUsuario =1 ');

	$Nrobiblios = mysqli_num_rows($tabla);
	?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/hoja_bibliotecario.css">

	<script type="text/javascript" src="js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

			<script type="text/javascript">
		$(function ListarDefault(){
			var parametros = {
			"dbusqueda": $("#txtbusqueda").val()
			};

			$.ajax({
			data: parametros,
			url: 'listarBibliotecario.php',
			type: 'POST',
			beforeSend: function(){
			$("#ListaBi").html("Procesando")
			},
			success: function(datos){
			$("#ListaBi").html(datos);
			}
			});


			})
		</script>



	<div id="ContenidoBi">
		
		<div id="DatosBi">
			


			<div id="tablaBi">
				
				<h1>GESTIONADORES DE LOS PRESTAMOS</h1>

				<div id="busqueda">

					<div id="BusquedaBi">
					<input type="text" id= "txtbusqueda" name="">
					<button type="button" onclick="ListarBibliotecario();">Buscar</button>
					</div>



				</div>

				<div id="ListaBi">
					
				</div>
				<p id="Nrobibliotecario"><?php echo "Cantidad de administradores: " .$Nrobiblios; ?></p>
			</div>


		</div>

	</div>
</body>
</html>
