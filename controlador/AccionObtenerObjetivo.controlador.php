<?php
	require_once '../negocio/Accion.class.php';
	$objAccion = new Accion();
	$resultado=$objAccion->obtenerObjetivo();
	echo json_encode($resultado);
?>