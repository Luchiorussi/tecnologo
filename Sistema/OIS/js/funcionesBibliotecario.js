function ListarBibliotecario(){
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


}





function VNuevoBi(){

	var parametros = {};

	$.ajax({
		data: parametros,
		url: 'VNueBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});

}


function VModificarBi(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VModBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});



}

function VEliminarBi(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VEliBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});

}


function DNuevoBi(){

	var parametros = {

		"vnombres": $('#txtnombres').val(),
		"vapellidos": $('#txtapellidos').val(),
		"vdireccion": $('#txtdireccion').val(),
		"vemail": $('#txtemail').val(),
		"vtelefono": $('#txttelefono').val(),
		"vdni": $('#txtdni').val(),
		"vnrocarnet": $('#txtnroCarnet').val(),
		"vclave": $('#txtclave').val()
		
	};

	$.ajax({
		data: parametros,
		url: 'DNueBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});

}


function DModificarBi(){

	var parametros = {
		"vcod": $('#txtcod').val(),
		"vnombres": $('#txtnombres').val(),
		"vapellidos": $('#txtapellidos').val(),
		"vdireccion": $('#txtdireccion').val(),
		"vemail": $('#txtemail').val(),
		"vtelefono": $('#txttelefono').val(),
		"vdni": $('#txtdni').val()
	};

	$.ajax({
		data: parametros,
		url: 'DModBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});

}

function DEliminarBi(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DEliBibliotecario.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoBi").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoBi").html(datos);
		}
	});

}