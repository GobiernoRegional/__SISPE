<?php
	require_once '../negocio/AccionInstitucional.php';
	$objAccionIns = new AccionInstitucional();
	$resultado=$objAccionIns->obtenerIndicador();
	echo json_encode($resultado);
?>