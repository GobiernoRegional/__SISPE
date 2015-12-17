<?php
	$politica=$_POST["txtnombre"];
	require_once '../negocio/politica.class.php';
	$objPolitica = new PoliticaR();
	$objPolitica->setDescripcion($politica);
	$resultado=$objPolitica->agregar();
	echo json_encode($resultado);
?>