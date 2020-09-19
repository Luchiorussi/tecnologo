<?php
include ('Conexion_Prestamo.php');

	$tabla = $cnmysql->query('SELECT * FROM aula');

	$NroLibros = mysqli_num_rows($tabla);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/hoja_libro.css">
<script type="text/javascript" src="js/funcioneslibro.js"></script>
</head>
<body>

<script type="text/javascript">
		$(function ListarDefault(){
			var parametros = {
			"dbusqueda": $("#txtbusqueda").val()
			};

			$.ajax({
			data: parametros,
			url: 'listarLibro.php',
			type: 'POST',
			beforeSend: function(){
			$("#ListaLi").html("Procesando")
			},
			success: function(datos){
			$("#ListaLi").html(datos);
			}
			});


			})
		</script>


	<div id="ContenidoLi">
		
		<div id="DatosLi">
			


			<div id="tablaLi">
				
				<h1>Lista de Aulas de la Institución</h1>
				<div id="busqueda">

					<div id="BusquedaLi">
					<input type="text" id= "txtbusqueda" name="" placeholder="Codigo del Aula, Nombre del aula">
					<button type="button" onclick="ListarLibro();">Buscar</button>
					
					</div>

					
				</div>

				<div id="ListaLi">
					
				</div>


				<p id="NroLibros"><?php echo "Cantidad de Aulas: " .$NroLibros; ?></p>

			</div>


		</div>

	</div>




</body>
</html>