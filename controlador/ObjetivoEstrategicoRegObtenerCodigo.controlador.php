<?php
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$resultado=$objObjetivo->ObtenerCodigo();
	echo json_encode($resultado);
?>