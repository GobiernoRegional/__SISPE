<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$resultado=$objObjetivoEspNac->leerDatos($codigo);
	echo json_encode($resultado);
?>