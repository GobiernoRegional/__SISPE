<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ProgramaEstrategia.class.php';
	$objProEstrategia = new ProgramaEstrategia();
	$resultado=$objProEstrategia->leerDatos($codigo);
	echo json_encode($resultado);
?>