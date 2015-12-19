<?php
	require_once '../negocio/PoliticaLineamiento.class.php';
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$resultado=$objPoliticaLineamiento->obtenerEjeEstrategico();
	echo json_encode($resultado);
?>