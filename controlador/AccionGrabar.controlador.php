<?php
	$accion=$_POST["txtnombre"];
	$objetivo = $_POST["txtobjetivo"];
	require_once '../negocio/Accion.class.php';
	$objAccion = new Accion();
	$objAccion->setDescripcion($accion);
        $objAccion->setObjetivo($objetivo);
	$resultado=$objAccion->agregar();
	echo json_encode($resultado);
?>