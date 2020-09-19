<?php

	include('Conexion_Prestamo.php');


	session_start();
	$id = $_SESSION['user_id'];

	$query= "SELECT Nombre, Apellido, NoDocumento FROM usuario WHERE id = '$id' ";

	$resultado = $cnmysql->query($query);

	$fila = mysqli_fetch_array($resultado);

	$nombre = $fila['Nombre'];
	$apellidos = $fila['Apellido'];
	$carnet = $fila['NoDocumento'];

	$texto = "Usuario: " .$nombre ." " .$apellidos ." | " ."NoDocumento: " .$carnet;

  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/vistas.js"></script>
	<script type="text/javascript" src="js/funcionesBibliotecario.js"></script>
	<script type="text/javascript" src="js/funcionesLector.js"></script>
	<script type="text/javascript" src="js/funcioneslibro.js"></script>
	<script type="text/javascript" src="js/funcionesAutor.js"></script>
	<script type="text/javascript" src="js/funcionesEditorial.js"></script>
	<script type="text/javascript" src="js/funcionesGenero.js"></script>
	<script type="text/javascript" src="js/funcionesAccionesLector.js"></script>
	<script type="text/javascript" src="js/funcionesPrestamo.js"></script>

	<link rel="stylesheet" href="css/hoja_index_bibliotecario.css">
	<title>GESTION DE PRESTAMOS</title>

</head>
<body  onload="VistaInicio()">
	<div id="contenedor">
		

		<header>
			
			<div id="titulo">
				<h1>GESTION DE PRESTAMO DE MOBILIARIO</h1>
				<h3> <?php echo $texto;?> </h3>
			</div>

			<div id="banner">
				<div> <img src="img/prestamo.jpg" width="1200" height="240"> </div>
			</div>

		</header>

		<br>
		<hr>

		<nav>
			<center>
				
				<ul id="menu">
					<li> <a onclick="VistaInicio();">Inicio</a> </li>
					<li><a onclick="VistaBibliotecario();">Administradores</a></li>
					<li><a>Prestamos</a> 
						<ul>
							<li> <a onclick="VistaPrestamo (<?php echo $id ?>);">Gestion Prestamos</a> </li>
							<li> <a onclick="VistaLibrosPrestados ();">Prestamos Realizados </a> </li>
							<li> <a onclick="VistaLibrosRetornados ();">Prestamos Finalizados </a> </li>
							<li> <a onclick="VistaLibrosReservadosBi ();">Prestamos Reservados </a> </li>
						</ul>
					</li>

						<li><a onclick="VistaLibro();">Aulas</a></li>
						<li><a onclick="VistaLector();">Mobiliario</a></li>
						<li><a href="Bienvenido.php">Salir</a></li>
				</ul>
			</center>
		</nav>

		<section>
			<div id="contenido">
				
			</div>
		</section>	


		<footer>
			<p>Sistema Gestor de inventario para la institucion Julio Cesar Turbay Ayala.</p>
		</footer>
	</div>
</body>
</html>