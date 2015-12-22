<?php
	require_once '../negocio/IndicadorRegional.class.php';
	$objIndicadorRegional = new IndicadorRegional();
	$resultado=$objIndicadorRegional->obtenerVariable();
	echo json_encode($resultado);
?>