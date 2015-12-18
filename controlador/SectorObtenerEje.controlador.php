<?php
	require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$resultado=$objTipoSector->obtenerEje();
	echo json_encode($resultado);
?>