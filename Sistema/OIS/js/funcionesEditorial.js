


function GuardarEditorial(){
	var parametros ={
		"veditorial" : $('#txtEditorial').val()
	};


	$.ajax({
		data: parametros,
		url: 'DNueEditorial.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			document.forms['FormAgregarEditorial'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}



function ModificarEditorial(){
	var parametros = {
		"vcod" : $('#txtcodEditorialMod').val(),
		"vautor" : $('#txtEditorialMod').val()
	};


	$.ajax({
		data: parametros,
		url: 'DModEditorial.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormModificarEditorial'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}


function EliminarEditorial(){
	var parametros = {
		"vcod" : $('#txtcodEditorialEli').val()
	};


	$.ajax({
		data: parametros,
		url: 'DEliEditorial.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormEliminarEditorial'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}