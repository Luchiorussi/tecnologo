function ListarStockLibro(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarStockMobiliario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLibros").html("Procesando")
		},
		success: function(datos){
			$("#ListaLibros").html(datos);
			
		}
	});


}

function VerificarLector(){
	var parametros ={
		"codLector" : $('#cboLector').val(),
	};


	$.ajax({
		data: parametros,
		url: 'DVerificarLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#MsjVerificarLector").html("Procesando")
		},
		success: function(datos){		
			$("#MsjVerificarLector").slideDown("fast");
			$("#MsjVerificarLector").html(datos);
		}
	});
}


function GuardarPrestamo(){
	var parametros ={
		
		"idUsuario" : $('#txtCodBi').val(),
		"idUsuario" : $('#cboLector').val(),
		"finFechaPrestamo" : $("#dtpFecha").val(),
		"idMobiliarioaula" : $("#txtCodLibro").val()
	};


	$.ajax({
		data: parametros,
		url: 'DGuardarPrestamo.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			ListarStockLibro();
			
			$("#txtCodLibro").val('');
			$("#MsjVerificarLector").slideUp("fast");
			$("#MsjVerificarPrestamo").slideDown("fast");
			$("#MsjVerificarPrestamo").html(datos);
		}
	});
}


function GuardarPrestamoPorReserva(){
	var parametros ={
		"CodReserva" : $('#txtCodReserva').val(),
		"codBibliotecario" : $('#txtCodBi').val(),
		"codLector" : $('#txtCodLe').val(),
		"fechaDevolucion" : $("#dtpFecha").val(),
		"CodLibro" : $("#txtCodLibro").val()
	};


	$.ajax({

		data: parametros,
		url: 'DGuardarPrestamoPorReserva.php',
		type: 'POST',
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);		
		}

	});
}


function ListarLibrosPrestados(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarLibrosPrestados.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLP").html("Procesando")
		},
		success: function(datos){
			$("#ListaLP").html(datos);
		}
	});


}

function ListarLibrosDevueltos(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarLibrosDevueltos.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLR").html("Procesando")
		},
		success: function(datos){
			$("#ListaLR").html(datos);
		}
	});


}

function VRetornarLibro(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VRetornarLibro.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLP").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLP").html(datos);
		}
	});

}


function DRetornarLibro(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DRetornarLibro.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLP").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLP").html(datos);
		}
	});

}


function ListarPorFecha(){
	var	parametros = {};

	$.ajax({
		data: parametros,
		url: "listarLibrosReservadoPorFecha.php",
		type: "POST",
		beforeSend: function(){
			$("#ListaLRSBi").html("Procesando");
		},
		success: function(data){
			$("#ListaLRSBi").html(data);	
		}
		});
}





function ListarLibrosReservadosBi(Cod){

			var parametros = {
			"dbusqueda": $("#txtbusqueda").val()
			};

			$.ajax({
			data: parametros,
			url: 'listarLibrosReservadosBi.php',
			type: 'POST',
			beforeSend: function(){
			$("#ListaLRSBi").html("Procesando")
			},
			success: function(datos){
			$("#ListaLRSBi").html(datos);
			}
			});


}
function VRetornarLibroReservadoBi(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VRetornarLibroReservadoBi.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLRSBi").html("Procesando");
		},
		success: function(datos){
			$("#ContenidoLRSBi").html(datos);
		}
	});

}

function DRetornarLibroReservadoBi(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DRetornarLibroReservadoBi.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLRSBi").html("Procesando");
		},
		success: function(datos){
			$("#ContenidoLRSBi").html(datos);
		}
	});

}


function VPrestamoPorReserva(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VPrestamoPorReserva.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLRSBi").html("Procesando");
		},
		success: function(datos){
			$("#ContenidoLRSBi").html(datos);
		}
	});

}