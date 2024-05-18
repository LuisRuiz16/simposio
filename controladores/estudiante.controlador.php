<?php

class Controladorestudiantes{

	/*=============================================
	CREAR estudiantes
	=============================================*/

	static public function ctrCrearestudiante(){

		if(isset($_POST["nuevoEstudiante"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEstudiante"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDPI"]) &&
			   preg_match('/^[0-9]+$/', $_POST["carnet"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
               preg_match('/^[0-9]+$/', $_POST["nuevaEdad"]) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccion"])){

			   	$tabla = "estudiantes";

			   	$datos = array("nombre"=>$_POST["nuevoEstudiante"],
					           "DPI"=>$_POST["nuevoDPI"],
							   "carnet"=>$_POST["carnet"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
                               "edad"=>$_POST["nuevaEdad"],
					           "direccion"=>$_POST["nuevaDireccion"]);

			   	$respuesta = Modeloestudiantes::mdlIngresarestudiante($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El estudiante ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "estudiante";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El estudiante no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estudiante";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR estudiantes
	=============================================*/

	static public function ctrMostrarestudiantes($item, $valor){

		$tabla = "estudiantes";

		$respuesta = Modeloestudiantes::mdlMostrarestudiantes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR estudiante
	=============================================*/

	static public function ctrEditarestudiante(){

		if(isset($_POST["editarestudiante"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarestudiante"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "estudiantes";

			   	$datos = array("id"=>$_POST["idestudiante"],
			   				   "nombre"=>$_POST["editarestudiante"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

			   	$respuesta = Modeloestudiantes::mdlEditarestudiante($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El estudiante ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "estudiantes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El estudiante no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estudiantes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR estudiante
	=============================================*/

	static public function ctrEliminarestudiante(){

		if(isset($_GET["idestudiante"])){

			$tabla ="estudiantes";
			$datos = $_GET["idestudiante"];

			$respuesta = Modeloestudiantes::mdlEliminarestudiante($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El estudiante ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "estudiantes";

								}
							})

				</script>';

			}		

		}

	}

}

