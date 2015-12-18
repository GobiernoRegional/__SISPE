<?php
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$resultado=$objObjetivo->obtenerEjes();
	echo json_encode($resultado);
?>