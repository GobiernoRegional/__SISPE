<?php
	require_once '../negocio/Politica.class.php';
	$objPolitica = new PoliticaR();
	$resultado=$objPolitica->obtenerSector();
	echo json_encode($resultado);
?>