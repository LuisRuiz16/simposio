<?php

require_once "../controladores/simposios.controlador.php";
require_once "../modelos/simposios.modelo.php";

class Ajaxsimposios{

	/*=============================================
	EDITAR simposio
	=============================================*/	

	public $idsimposio;

	public function ajaxEditarsimposio(){

		$item = "id";
		$valor = $this->idsimposio;

		$respuesta = Controladorsimposios::ctrMostrarsimposios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR simposio
	=============================================*/	

	public $activarsimposio;
	public $activarId;


	public function ajaxActivarsimposio(){

		$tabla = "simposios";

		$item1 = "estado";
		$valor1 = $this->activarsimposio;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = Modelosimposios::mdlActualizarsimposio($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR simposio
	=============================================*/	

	public $validarsimposio;

	public function ajaxValidarsimposio(){

		$item = "simposio";
		$valor = $this->validarsimposio;

		$respuesta = Controladorsimposios::ctrMostrarsimposios($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR simposio
=============================================*/
if(isset($_POST["idsimposio"])){

	$editar = new Ajaxsimposios();
	$editar -> idsimposio = $_POST["idsimposio"];
	$editar -> ajaxEditarsimposio();

}

/*=============================================
ACTIVAR simposio
=============================================*/	

if(isset($_POST["activarsimposio"])){

	$activarsimposio = new Ajaxsimposios();
	$activarsimposio -> activarsimposio = $_POST["activarsimposio"];
	$activarsimposio -> activarId = $_POST["activarId"];
	$activarsimposio -> ajaxActivarsimposio();

}

/*=============================================
VALIDAR NO REPETIR simposio
=============================================*/

if(isset( $_POST["validarsimposio"])){

	$valsimposio = new Ajaxsimposios();
	$valsimposio -> validarsimposio = $_POST["validarsimposio"];
	$valsimposio -> ajaxValidarsimposio();

}