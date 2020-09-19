function ListarLibros(){
	var parametros = {
		"dbusqueda": $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarlibros.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLi").html("Procesando")
		},
		success: function(datos){
			$("#ListaLi").html(datos);
		}
	});


}

