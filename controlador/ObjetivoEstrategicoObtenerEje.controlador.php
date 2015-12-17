<?php
	require_once '../negocio/objetivoEstrategico.class.php';
	$objObjetivo = new Objetivo();
	$resultado=$objObjetivo->obtenerEjes();
	echo json_encode($resultado);
?>