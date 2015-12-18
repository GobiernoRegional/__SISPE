<?php
	require_once '../negocio/Indicador.class.php';
	$objIndicador = new Indicador();
	$resultado=$objIndicador->obtenerObjetivoEstNacional();
	echo json_encode($resultado);
?>