<?php
	require_once '../negocio/Variable.class.php';
	$objVariable = new Variable();
	$resultado=$objVariable->obtenerTipoSector();
	echo json_encode($resultado);
?>