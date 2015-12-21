<?php
	$codigo = $_POST["codigo"];
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$resultado=$objObjetivo->leerDatos($codigo);
	echo json_encode($resultado);
?>