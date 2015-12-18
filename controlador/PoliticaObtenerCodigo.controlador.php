<?php
	require_once '../negocio/Politica.class.php';
	$objPolitica = new PoliticaR();
	$resultado=$objPolitica->ObtenerCodigo();
	echo json_encode($resultado);
?>