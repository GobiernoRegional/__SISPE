<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ProgramaInversion.class.php';
	$objProInversion = new ProgramaInversion();
	$resultado=$objProInversion->leerDatos($codigo);
	echo json_encode($resultado);
?>