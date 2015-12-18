<?php
	require_once '../negocio/ProgramaInversion.class.php';
	$objProInversion= new ProgramaInversion();
	$resultado=$objProInversion->obtenerCiudades();
	echo json_encode($resultado);
?>