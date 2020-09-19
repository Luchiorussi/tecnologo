function ListarReservaLibro(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarStockLibros.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListLibros").html("Procesando");
		},
		success: function(datos){
			$("#ListLibros").html(datos);
		}
	});


}


function ReservarLibro(){
	var parametros = {
		"codLector": $("#txtCodLector").val(),
		"codLibro": $("#txtCodLibro").val()
	};

	$.ajax({
		data: parametros,
		url: 'DReservarLibro.php',
		type: 'POST',
		beforeSend: function(){
			$("#MsjReserva").html("Procesando");
		},
		success: function(datos){
			ListarReservaLibro();
			$("#MsjReserva").slideDown("fast");
			$("#MsjReserva").html(datos);
		}
	});


}



function ListarLibrosReservados(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
		
	};

	$.ajax({
		data: parametros,
		url: 'listarLibrosReservados.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLRS").html("Procesando");
		},
		success: function(datos){
			ListarReservaLibro();
			$("#ListaLRS").html(datos);
		}
	});


}


function VRetornarLibroReservado(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VRetornarLibroReservado.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLRS").html("Procesando");
		},
		success: function(datos){
			$("#ContenidoLRS").html(datos);
		}
	});

}


function DRetornarLibroReservado(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DRetornarLibroReservado.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLRS").html("Procesando");
		},
		success: function(datos){
			$("#ContenidoLRS").html(datos);
		}
	});

}