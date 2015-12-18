<?php
	require_once '../negocio/Indicador.class.php';
	$objIndicador = new Indicador();
	$resultado=$objIndicador->obtenerVariable();
	echo json_encode($resultado);
?>