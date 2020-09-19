<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/vistas.js"></script>
			<link rel="stylesheet" href="css/hoja_inicio.css">
			<title>
				
			</title>
	</head>
		<body>
			<div id="ContInicio">

			<div id="tituloContenido">
				<h1>Bienvenido a la Gestion de Prestamos</h1>
			</div>

			<div id="slider">
				<div><img src="img/imagen1.jpg" width="900" height="300"></div>
				<div><img src="img/imagen2.jpg" width="900" height="300"></div>
				<div><img src="img/imagen3.jpg" width="900" height="300"></div>
			</div>

			<div id="section">
				<div id="article1">
					<img src="img/imagen6.jpg" width="200" height="200">
					<h1>¿Que es un Prestamo?</h1>
					<p>
						Un prestamo es la gestion que se realiza por medio de dos o mas personas, con lo cual el usuario administrador asigna a la persona que solicita el mobiliario, con el fin de que en un limite de tiempo la persona a la que se asigno el mobiliario lo devuelva en el mismo estamo que se le entrego; Esto facilita la solucion de perdidas o robo del mobiliario.
					</p>
				</div>

				<div id="article2">
					<img src="img/imagen5.jpg" width="200" height="200">
					<h1>¿Beneficios del Prestamo?</h1>
					<p>
						Los direntes benificios que tiene solicitar un prestamo son los siguientes ante cualquier situacion: <br> <br>
						- Conocimiento del mobiliario existente en la institucion educativa Julio Cesar Turbay Ayala. <br>
						- Conocimiento de las perdidas o daños que se esten presentando en la institucion. 
					</p>
				</div>
			</div>
	</div>

	<script type="text/javascript">
		$(function(){

			$("#slider div:gt(0)").hide();

			setInterval(function(){
				$("#slider div:first-child").fadeOut(1000)
				.next("div").fadeIn(1000)
				.end().appendTo("#slider");
			},3000);

		})

	</script>
		</body>
</html>