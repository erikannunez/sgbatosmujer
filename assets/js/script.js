//Agregar Persona
$( "#guardarPersona" ).submit(function( event ) { //name del form
  $('#guardarDatos').attr("disabled", true); //id del submit
  
 var parametros = $(this).serialize();
 var base = '/panel/addpersona'; //URL a la que apuntaría el form
	 $.ajax({
			type: "POST",
			url: base,
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultadoPersona").html("Mensaje: Cargando..."); //Div vacío para poner cargando...
			  },
			success: function(datos){
			$("#resultadoPersona").html(datos);
			$('#guardarDatos').attr("disabled", false);
		  }
	});
  event.preventDefault();
})
//Editar persona
$( "#editarPersona" ).submit(function( event ) { //name del form
  $('#actualizarDatos').attr("disabled", true); //id del submit
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "/panel/updatepersona", //URL a la que apuntaría el form
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultadosEditarPersona").html("Mensaje: Cargando..."); //Div vacío para poner cargando...
			  },
			success: function(datos){
			$("#resultadosEditarPersona").html(datos);
			$('#actualizarDatos').attr("disabled", false);
		  }
	});
  event.preventDefault();
})
