<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$resultado=$objEstrategia->leerDatos($codigo);
	echo json_encode($resultado);
?>