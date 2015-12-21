<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/IndicadorNacional.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$resultado=$objIndicadorNacional->leerDatos($codigo);
	echo json_encode($resultado);
?>