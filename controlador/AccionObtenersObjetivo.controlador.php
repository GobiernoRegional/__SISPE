<?php
	require_once '../negocio/Accion.class.php';
	$objAccion = new Accion();
	$resultado=$objAccion->obtenerObejetivo();
	echo json_encode($resultado);
?>