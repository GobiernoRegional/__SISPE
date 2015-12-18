<?php
	require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$resultado=$objTipoSector->obtenerObjetivo();
	echo json_encode($resultado);
?>