<?php
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$resultado=$objObjetivoEspNac->obtenerEjes();
	echo json_encode($resultado);
?>