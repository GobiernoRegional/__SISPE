<?php
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$resultado=$objArea->ObtenerCodigo();
	echo json_encode($resultado);
?>