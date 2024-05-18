<?php

require_once "conexion.php";

class Modeloeventos{

	/*=============================================
	CREAR EVENTOS
	=============================================*/

	static public function mdlIngresarEvento($tabla, $datos){
		$horaInicioFormateada = date('H:i', strtotime($_POST["horadeinicio"]));

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_evento, hora_inicio, hora_finalizacion, fecha_evento, direccion_evento, nombre_expositor, datos_expositor) VALUES (:eventogeneral, :horadeinicio, :horafinal, :fechaevento, :direccionevento, :nombreexpositor, :informacionexpositor)");
	

		$stmt->bindParam(":eventogeneral", $datos["nombre_evento"], PDO::PARAM_STR);
		$stmt->bindParam(":horadeinicio", $horaInicioFormateada, PDO::PARAM_STR); // Se inserta la hora formateada
		$stmt->bindParam(":horafinal", $datos["hora_finalizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaevento", $datos["fecha_evento"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionevento", $datos["direccion_evento"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreexpositor", $datos["nombre_expositor"], PDO::PARAM_STR);
		$stmt->bindParam(":informacionexpositor", $datos["datos_expositor"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR Eventos
	=============================================*/

	static public function mdlMostrarEventos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Eventos
	=============================================*/

	static public function mdlEditarEventos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR Eventos
	=============================================*/

	static public function mdlEliminarEventos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR Evento
	=============================================*/

	static public function mdlActualizarEvento($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}