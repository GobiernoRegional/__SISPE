<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/politica.class.php';
	$objPolitica = new PoliticaR();
	$objPolitica->setCodigo($codigo);
	$resultado=$objPolitica->eliminar();
	echo json_encode($resultado);
?>