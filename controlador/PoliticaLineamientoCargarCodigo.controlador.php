<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/PoliticaLineamiento.class.php';
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$resultado=$objPoliticaLineamiento->leerDatos($codigo);
	echo json_encode($resultado);
?>