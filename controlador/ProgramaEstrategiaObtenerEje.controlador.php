<?php
	require_once '../negocio/ProgramaEstrategia.class.php';
	$objProEstrategia = new ProgramaEstrategia();
	$resultado=$objProEstrategia->obtenerEjeEstrategico();
	echo json_encode($resultado);
?>