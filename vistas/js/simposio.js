/*=============================================
SUBIENDO LA FOTO DEL simposio
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 15000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR simposio
=============================================*/
$(".tablas").on("click", ".btnEditarsimposio", function(){

	var idsimposio = $(this).attr("idsimposio");
	
	var datos = new FormData();
	datos.append("idsimposio", idsimposio);

	$.ajax({

		url:"ajax/simposios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarsimposio").val(respuesta["simposio"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

})

/*=============================================
ACTIVAR simposio
=============================================*/
$(".tablas").on("click", ".btnActivar", function(){

	var idsimposio = $(this).attr("idsimposio");
	var estadosimposio = $(this).attr("estadosimposio");

	var datos = new FormData();
 	datos.append("activarId", idsimposio);
  	datos.append("activarsimposio", estadosimposio);

  	$.ajax({

	  url:"ajax/simposios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El simposio ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "simposios";

			        }


				});

	      	}

      }

  	})

  	if(estadosimposio == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadosimposio',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadosimposio',0);

  	}

})

/*=============================================
REVISAR SI EL simposio YA ESTÁ REGISTRADO
=============================================*/

$("#nuevosimposio").change(function(){

	$(".alert").remove();

	var simposio = $(this).val();

	var datos = new FormData();
	datos.append("validarsimposio", simposio);

	 $.ajax({
	    url:"ajax/simposios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevosimposio").parent().after('<div class="alert alert-warning">Este simposio ya existe en la base de datos</div>');

	    		$("#nuevosimposio").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR simposio
=============================================*/
$(".tablas").on("click", ".btnEliminarsimposio", function(){

  var idsimposio = $(this).attr("idsimposio");
  var fotosimposio = $(this).attr("fotosimposio");
  var simposio = $(this).attr("simposio");

  swal({
    title: '¿Está seguro de borrar el simposio?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar simposio!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=simposios&idsimposio="+idsimposio+"&simposio="+simposio+"&fotosimposio="+fotosimposio;

    }

  })

})




