

function GuardarGenero(){
	var parametros ={
		"vgenero" : $('#txtGenero').val()
	};


	$.ajax({
		data: parametros,
		url: 'DNueGenero.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			document.forms['FormAgregarGenero'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}



function ModificarGenero(){
	var parametros = {
		"vcod" : $('#txtcodGeneroMod').val(),
		"vgenero" : $('#txtGeneroMod').val()
	};


	$.ajax({
		data: parametros,
		url: 'DModGenero.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormModificarGenero'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}


function EliminarGenero(){
	var parametros = {
		"vcod" : $('#txtcodGeneroEli').val(),
	};


	$.ajax({
		data: parametros,
		url: 'DEliGenero.php',
		type: 'POST',
		beforeSend: function(){
			$("#CajaMensaje").html("Procesando")
		},
		success: function(datos){
			
			document.forms['FormEliminarGenero'].reset();
			$("#CajaMensaje").slideDown("fast");
			$("#CajaMensaje").html(datos);
		}
	});
}