<?php

require_once "../controladores/eventos.controlador.php";
require_once "../modelos/eventos.modelo.php";

class Ajaxeventos{

	/*=============================================
	EDITAR evento
	=============================================*/	

	public $idevento;

	public function ajaxEditarevento(){

		$item = "id";
		$valor = $this->idevento;

		$respuesta = Controladoreventos::ctrMostrareventos($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR evento
=============================================*/	

if(isset($_POST["idevento"])){

	$evento = new Ajaxeventos();
	$evento -> idevento = $_POST["idevento"];
	$evento -> ajaxEditarevento();

}