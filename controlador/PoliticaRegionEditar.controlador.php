<?php
	$codigo=$_POST["txtcodigoedit"];
	$politica = $_POST["txtnombreedit"];
	require_once '../negocio/Politica.class.php';
	$objPolitica = new PoliticaR();
	$objPolitica->setCodigo($codigo);
	$objPolitica->setDescripcion($politica);
	$resultado=$objPolitica->editar();
	echo json_encode($resultado);
?>