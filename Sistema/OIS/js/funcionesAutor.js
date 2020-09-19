


function ListarAutor(){
			var parametros = {};

			$.ajax({
			data: parametros,
			url: 'listarAutor.php',
			type: 'POST',
			beforeSend: function(){
			$("#listAutores").html("Procesando")
			},
			success: function(datos){
			$("#listAutores").html(datos);
			}
			});


}




function GuardarAutor(){
	var parametros ={
		"vautor" : $('#txtautor').val(),
	};


	$.ajax({
		data: parametros,
		url: 'DNueAutor.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			document.forms['FormAgregarAutor'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}



function ModificarAutor(){
	var parametros = {
		"vcod" : $('#txtcodautorMod').val(),
		"vautor" : $('#txtautorMod').val()
	};


	$.ajax({
		data: parametros,
		url: 'DModAutor.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormModificarAutor'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}


function EliminarAutor(){
	var parametros = {
		"vcod" : $('#txtcodautorEli').val(),
	};


	$.ajax({
		data: parametros,
		url: 'DEliAutor.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormEliminarAutor'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}