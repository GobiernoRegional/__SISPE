<?php
	require_once '../negocio/ProgramaInversion.class.php';
	$objProInversion= new ProgramaInversion();
	$resultado=$objProInversion->obtenerProgramaEstrategia();
	echo json_encode($resultado);
?>