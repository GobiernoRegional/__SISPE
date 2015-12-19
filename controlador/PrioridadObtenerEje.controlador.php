<?php
	require_once '../negocio/Prioridad.class.php';
	$objPrioridad = new Prioridad();
	$resultado=$objPrioridad->obtenerEjeEstrategico();
	echo json_encode($resultado);
?>