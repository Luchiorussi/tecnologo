
function VistaInicio(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vinicio.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}



function VistaBibliotecario(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vbibliotecario.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}


function VistaLector(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vlector.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}

function VistaLibro(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vlibro.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}

function VistaDetalleAutor(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VDetAutor.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}

function VistaDetalleEditorial(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VDetEditorial.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}


function VistaDetalleGenero(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VDetGenero.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}


function VistaPrestamo(Cod){

	var parametros = {
		"cod" : Cod
	};

	$.ajax({

		data: parametros,
		url: "Vprestamo.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}


function VistaLibrosPrestados(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vlibrosprestados.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}


function VistaLibrosRetornados(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vlibrosretornados.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}


function VistaReserva(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VReservarLibros.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}

function VistaLibrosReservados(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VLibrosReservados.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}


function VistaLibrosReservadosBi(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Mobiliario_Reservado.php.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}


function VistaLibrosPrestadosLector(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VlibrosPrestadosLector.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}



function VistaLibrosDevueltosLector(){

	var parametros = {};

	$.ajax({

		data: parametros,
		url: "VlibrosDevueltosLector.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
			
		}

	});
}
