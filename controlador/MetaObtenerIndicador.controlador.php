<?php
	require_once '../negocio/Meta.class.php';
	$objMeta = new Meta();
	$resultado=$objMeta->obtenerIndicador();
	echo json_encode($resultado);
?>