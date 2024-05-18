<?php

class Controladoreventos{

	/*=============================================
	CREAR eventos
	=============================================*/

	static public function ctrCrearevento(){

		if(isset($_POST["eventogeneral"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["eventogeneral"]) &&
				preg_match('/^(?:[0-1]?[0-9]):[0-5][0-9](?:AM|PM)?$/', $_POST["horadeinicio"]) &&
			   preg_match('/^(?:[0-1][0-9]|2[0-3]):[0-5][0-9]$/', $_POST["horafinal"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["direccionevento"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["fechaevento"]) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreexpositor"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["informacionexpositor"])){

			   	$tabla = "eventos";

			   	$datos = array("nombre_evento"=>$_POST["eventogeneral"],
					           "hora_inicio"=>$_POST["horadeinicio"],
					           "hora_finalizacion"=>$_POST["horafinal"],
							   "direccion_evento"=>$_POST["direccionevento"],
							   "fecha_evento"=>$_POST["fechaevento"],
							   "nombre_expositor"=>$_POST["nombreexpositor"],
					           "datos_expositor"=>$_POST["informacionexpositor"]);

							  //echo $datos;

			   	$respuesta = Modeloeventos::mdlIngresarevento($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El evento ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "eventos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El evento no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "eventos";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR eventos
	=============================================*/

	static public function ctrMostrareventos($item, $valor){

		$tabla = "eventos";

		$respuesta = Modeloeventos::mdlMostrareventos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR evento
	=============================================*/

	static public function ctrEditarevento(){

		if(isset($_POST["editarevento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarevento"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "eventos";

			   	$datos = array("id"=>$_POST["idevento"],
			   				   "nombre"=>$_POST["editarevento"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

			   	$respuesta = Modeloeventos::mdlEditareventos($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El evento ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "eventos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El evento no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "eventos";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR evento
	=============================================*/

	static public function ctrEliminareventos(){

		if(isset($_GET["idevento"])){

			$tabla ="eventos";
			$datos = $_GET["idevento"];

			$respuesta = Modeloeventos::mdlEliminarEventos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El evento ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "eventos";

								}
							})

				</script>';

			}		

		}

	}

}

