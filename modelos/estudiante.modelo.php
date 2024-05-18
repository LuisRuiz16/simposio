<?php

require_once "conexion.php";

class Modeloestudiantes{

	/*=============================================
	CREAR estudiante
	=============================================*/

	static public function mdlIngresarestudiante($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, carnet, DPI, email, telefono, edad, direccion) VALUES (:nuevoEstudiante, :carnet, :nuevoDPI, :nuevoEmail, :nuevoTelefono, :nuevaEdad, :nuevaDireccion)");

		$stmt->bindParam(":nuevoEstudiante", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carnet", $datos["carnet"], PDO::PARAM_INT);
		$stmt->bindParam(":nuevoDPI", $datos["DPI"], PDO::PARAM_INT);
		$stmt->bindParam(":nuevoEmail", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":nuevoTelefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":nuevaEdad", $datos["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":nuevaDireccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR estudianteS
	=============================================*/

	static public function mdlMostrarestudiantes($tabla, $item, $valor){

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
	EDITAR estudiante
	=============================================*/

	static public function mdlEditarestudiante($tabla, $datos){

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
	ELIMINAR estudiante
	=============================================*/

	static public function mdlEliminarestudiante($tabla, $datos){

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
	ACTUALIZAR estudiante
	=============================================*/

	static public function mdlActualizarestudiante($tabla, $item1, $valor1, $valor){

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