<?php
	require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
	$resultado=$objVariableRegional->obtenerObjetivoEstrategico();
	echo json_encode($resultado);
?>