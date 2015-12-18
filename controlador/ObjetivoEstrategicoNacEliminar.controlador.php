<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$objObjetivoEspNac->setCodigo($codigo);
	$resultado=$objObjetivoEspNac->eliminar();
	echo json_encode($resultado);
?>