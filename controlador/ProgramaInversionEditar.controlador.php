<?php
	$codigo=$_POST["txtcodigoedit"];
	$accion = $_POST["txtnombreedit"];
        $objetivo = $_POST["txtobjetivoedit"];
        require_once '../negocio/Accion.class.php';
	$objAccion = new Accion();
	$objAccion->setCodigo($codigo);
	$objAccion->setDescripcion($accion);
        $objAccion->setObjetivo($objetivo);
	$resultado=$objAccion->editar();
	echo json_encode($resultado);
?>