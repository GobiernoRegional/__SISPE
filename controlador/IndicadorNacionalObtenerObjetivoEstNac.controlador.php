<?php
	require_once '../negocio/IndicadorNacional.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$resultado=$objIndicadorNacional->obtenerObjetivoEstNacional();
	echo json_encode($resultado);
?>