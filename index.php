<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/simposios.controlador.php";
require_once "controladores/evento.controlador.php";
require_once "controladores/estudiante.controlador.php";
require_once "controladores/ventas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/simposios.modelo.php";
require_once "modelos/estudiante.modelo.php";
require_once "modelos/evento.modelo.php";
require_once "modelos/ventas.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();