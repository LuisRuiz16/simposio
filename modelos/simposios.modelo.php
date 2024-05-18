<?php

require_once "conexion.php";

class Modelosimposios{


	/*=============================================
	MOSTRAR Eventos
	=============================================*/

	static public function mdlMostrarsimposios($tabla, $item, $valor){

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
	REGISTRO DE simposio
	=============================================*/
	static public function mdlIngresarsimposio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_estudiante, id_evento, comprobante) VALUES (:Estudiante, :Evento, :comprobante)");
		//******* */
		$file_name=$_FILES['nuevaFoto']['name'];
		$var = rand(10000,999999) * rand(10000,999999);
		$var = md5($var);
		$add="vistas/img/imgcomprobante/".$var."".$file_name;
		$nombre = $var."".$file_name;
		move_uploaded_file ($_FILES['nuevaFoto']['tmp_name'], $add);


		$stmt->bindParam(":Estudiante", $datos["id_estudiante"], PDO::PARAM_INT);
		$stmt->bindParam(":Evento", $datos["id_evento"], PDO::PARAM_INT);
        $stmt->bindParam(":comprobante", $nombre, PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			return "ok";

		}else{
			echo "Error al insertar en la base de datos: " . $stmt->errorInfo()[2];

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR simposio
	=============================================*/
	static public function mdlEditarsimposio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR simposio
	=============================================*/

	static public function mdlEliminarsimposio($tabla, $datos){

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
	ACTUALIZAR simposio
	=============================================*/

	static public function mdlActualizarsimposio($tabla, $item1, $valor1, $valor){

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

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}



}