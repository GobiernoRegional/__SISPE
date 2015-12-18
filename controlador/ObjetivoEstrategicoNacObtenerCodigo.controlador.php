<?php
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$resultado=$objObjetivoEspNac->ObtenerCodigo();
	echo json_encode($resultado);
?>