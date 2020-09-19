<?php

	include('Conexion_Prestamo.php');

	$dcodDp = $_POST['vcod'];



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/hoja_EliLector.css">
	<title></title>
</head>
<body>
	<div id="CEliLe">
		
		<div id="CajaMensaje">
			<h1><strong>Mensaje del Sistema</strong></h1>
			<p>¿Desea Retornar este Libro?</p>
			<div>
				<button type="button" onclick="DRetornarLibro(<?php echo $dcodDp ;?>);">Aceptar</button>
				<button type="button" onclick="VistaLibrosPrestados();">Cancelar</button>
			</div>
		</div>


	</div>

</body>
</html>
