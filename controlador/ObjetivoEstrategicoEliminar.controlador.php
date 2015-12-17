<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/objetivoEstrategico.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setCodigo($codigo);
	$resultado=$objObjetivo->eliminar();
	echo json_encode($resultado);
?>