<?php
	require_once '../negocio/politica.class.php';
	$objPolitica = new PoliticaR();
	$resultado=$objPolitica->ObtenerCodigo();
	echo json_encode($resultado);
?>