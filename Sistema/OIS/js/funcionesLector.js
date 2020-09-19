function ListarLector(){
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


}





function VNuevoLe(){

	var parametros = {};

	$.ajax({
		data: parametros,
		url: 'VNueLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});

}


function VModificarLe(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VModLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});



}

function VEliminarLe(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VEliLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});

}


function DNuevoLe(){

	var parametros = {

		"vnombres": $('#txtnombres').val(),
		"vapellidos": $('#txtapellidos').val(),
		"vdireccion": $('#txtdireccion').val(),
		"vemail": $('#txtemail').val(),
		"vtelefono": $('#txttelefono').val(),
		"vnrocarnet": $('#txtnroCarnet').val(),
		"vclave": $('#txtclave').val()
		
	};

	$.ajax({
		data: parametros,
		url: 'DNueLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});

}


function DModificarLe(){

	var parametros = {
		"vcod": $('#txtcod').val(),
		"vnombres": $('#txtnombres').val(),
		"vapellidos": $('#txtapellidos').val(),
		"vdireccion": $('#txtdireccion').val(),
		"vemail": $('#txtemail').val(),
		"vtelefono": $('#txttelefono').val()

	};

	$.ajax({
		data: parametros,
		url: 'DModLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});

}

function DEliminarLe(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DEliLector.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLe").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLe").html(datos);
		}
	});

}