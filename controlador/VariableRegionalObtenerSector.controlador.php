<?php
	require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
	$resultado=$objVariableRegional->obtenerTipoSector();
	echo json_encode($resultado);
?>