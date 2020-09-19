
<?php
$fecha = date('Y-m-d');

$nuevafecha     = strtotime('-1 day', strtotime($fecha));
$nuevafechaYear = strtotime('+1 year', strtotime($fecha));

$FechaActual = date('Y-m-d', $nuevafecha);
$FechaMaxima = date('Y-m-d', $nuevafechaYear);

include 'Conexion_Prestamo.php';

$id = $_POST['cod'];

$query = "SELECT Nombre,Apellido,NoDocumento FROM usuario WHERE id= '$id' ";

$resultado = $cnmysql->query($query);

$fila = mysqli_fetch_array($resultado);

$nombre    = $fila['Nombre'];
$apellidos = $fila['Apellido'];
$carnet    = $fila['NoDocumento'];

$texto = " " . $nombre . " " . $apellidos;

$lectores = $cnmysql->query("SELECT * FROM usuario");

?>

	<script type="text/javascript">
		var	carnetBi = '<?php echo $texto; ?>'
		$('#txtCarnetBi').val(carnetBi);
	</script>

	<!DOCTYPE html>
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/hoja_prestamo.css">
			<meta charset="utf-8">
			<time></time>
		</head>

		<script type="text/javascript">

			$(function VistaDefault(){

		var parametros = {
			"dbusqueda": $("#txtbusqueda").val()
		};

		$.ajax({
			data: parametros,
			url: 'listarStockLibros.php',
			type: 'POST',
			beforeSend: function(){
				$("#ListaLibros").html("Procesando")
			},
			success: function(datos){
				$("#ListaLibros").html(datos);
			}
		});
		}
	)



</script>
<body>
	<div id="ContPrestamo">
		<div id="ContDatos">
			<h1>PRESTAMOS</h1>
			<form id="FormPrestamo">

				<div>
					<label for="txtCarnetBi">Nombre del Aministrador:</label>
					<input type="hidden" value="<?php echo $id; ?>" id="txtCodBi">
					<input type="text" id="txtCarnetBi" readonly>
				</div>

				<div>
					<label for="txtCarnetLe">NoDocumento Usuario:</label>
					<div>
						<select class="js-example-basic-single" id="cboLector">
						<?php

while ($fila = mysqli_fetch_array($lectores)) {
    echo "<option value='" . $fila['id'] . "'>" . $fila['NoDocumento'] . "</option>";
}
?>
						</select>

						<button type="button" onclick="VerificarLector()">Verificar</button>
					</div>

				</div>

				<div id="MsjVerificarLector">

				</div>


				<div>
					<label for="dtpFecha">Fecha de la Devolucion:</label>
					<input type="date" id="dtpFecha" step="1" min="<?php echo $FechaActual; ?>" max="<?php echo $FechaMaxima; ?>" value="<?php echo $FechaActual; ?>">
				</div>

				<div>
					<label for="txtCodLibro">Código Mobiliario:</label>
					<div>
						<input type="number" id="txtCodLibro" min="1">

					</div>
				</div>

				<div id="MsjVerificarLibro">

				</div>

				<div id="botones">
					<button type="button" onclick="GuardarPrestamo();">Guardar Préstamo</button>
					<button type="button" onclick="VistaInicio();">Cancelar Préstamo</button>
				</div>

				<div id="MsjVerificarPrestamo">

				</div>
			</form>

		</div>


		<div id="ContListLibros">
			<h1>Lista de Mobiliario</h1>
			<div id="busqueda">

				<input type="text" id="txtbusqueda" placeholder="Titulo,Autor,Editorial,Genero">
				<button type="button" onclick="ListarStockLibro();">Buscar</button>


			</div>


			<div id="ListaLibros">

			</div>

		</div>
	</div>


</body>
</html>