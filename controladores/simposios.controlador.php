<?php

class Controladorsimposios{

	/*=============================================
	MOSTRAR eventos
	=============================================*/

	static public function ctrMostrarsimposios($item, $valor){

		$tabla = "simposios";

		$respuesta = Modelosimposios::mdlMostrarsimposios($tabla, $item, $valor);

		return $respuesta;

	}

		/*=============================================
	CREAR eventos
	=============================================*/

	static public function ctrCrearsimposio() {

		if (isset($_POST["Evento"])) {
	
			if (
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["Evento"]) && 
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["Estudiante"])) {
	
    
				$tabla = "simposios";
	
				$datos = array(
					"id_evento" => $_POST["Evento"],
					"id_estudiante" => $_POST["Estudiante"],
					"comprobante" => $_POST["nombreImagen"],
					"nuevaFoto" => $_POST["nuevaFoto"] // Obtener el nombre de la imagen del formulario

				);
				
				$respuesta = Modelosimposios::mdlIngresarsimposio($tabla, $datos);
				
	
				if ($respuesta == "ok") {
					echo '<script>
					swal({
						type: "success",
						title: "El evento ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							window.location = "simposio";
						}
					})
					</script>';
				}
	
			} else {
	
				echo '<script>
				swal({
					type: "error",
					title: "¡El evento no puede ir vacío o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "simposio";
					}
				})
				</script>';
			}
		}
	}
	
	/*=============================================
	EDITAR simposio
	=============================================*/

	static public function ctrEditarsimposio(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["imagenActual"];

			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/simposios/".$_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/simposios/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/simposios/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/simposios/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "simposios";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);

				$respuesta = Modelosimposios::mdlEditarsimposio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El simposio ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "simposios";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El simposio no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "simposios";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR simposio
	=============================================*/
	static public function ctrEliminarsimposio(){

		if(isset($_GET["idsimposio"])){

			$tabla ="simposios";
			$datos = $_GET["idsimposio"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/simposios/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/simposios/'.$_GET["codigo"]);

			}

			$respuesta = Modelosimposios::mdlEliminarsimposio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El simposio ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "simposios";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "simposios";

		$respuesta = Modelosimposios::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}





    // Esta función recibe el ID del estudiante y retorna su nombre
    static public function getNombreEstudiante($id_estudiante) {
        $stmt = Conexion::conectar()->prepare("SELECT nombre FROM estudiantes WHERE id = :id");
        $stmt->bindParam(":id", $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()["nombre"];
    }

    // Esta función recibe el ID del evento y retorna su nombre
    static public function getNombreEvento($id_evento) {
        $stmt = Conexion::conectar()->prepare("SELECT nombre_evento FROM eventos WHERE id_evento = :id");
        $stmt->bindParam(":id", $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()["nombre_evento"];
    }
    
    // Otras funciones del controlador, incluido ctrMostrarsimposios, etc.

}
