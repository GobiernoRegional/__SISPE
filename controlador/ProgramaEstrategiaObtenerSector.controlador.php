<?php
	require_once '../negocio/ProgramaEstrategia.class.php';
	$objProEstrategia = new ProgramaEstrategia();
	$resultado=$objProEstrategia->obtenerTipoSector();
	echo json_encode($resultado);
?>