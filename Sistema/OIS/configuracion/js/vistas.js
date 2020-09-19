
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
			$("#contenido").empty();
			$("#contenido").html(vista);
		}

	});
}

function VistaLibros(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vlibros.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}


function VistaAcercaDe(){
	var parametros = {};

	$.ajax({

		data: parametros,
		url: "Vacercade.php",
		type: "POST",
		beforeSend: function(){
			$("#contenido").html();
		},
		success: function(vista){
			$("#contenido").html(vista);
		}

	});
}



