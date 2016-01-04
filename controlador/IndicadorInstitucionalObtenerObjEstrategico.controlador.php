<?php
	require_once '../negocio/IndicadorInstitucional.php';
	$objIndicadorInst = new IndicadorInstitucional();
	$resultado=$objIndicadorInst->obtenerObjetivoEstrategico();
	echo json_encode($resultado);
?>