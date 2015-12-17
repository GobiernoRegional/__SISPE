<?php
	require_once '../negocio/objetivoEstrategico.class.php';
	$objObjetivo = new Objetivo();
	$resultado=$objObjetivo->ObtenerCodigo();
	echo json_encode($resultado);
?>