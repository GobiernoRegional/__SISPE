<?php
	require_once '../negocio/ProgramaEstrategia.class.php';
	$objProEstrategia = new ProgramaEstrategia();
	$resultado=$objProEstrategia->ObtenerCodigo();
	echo json_encode($resultado);
?>