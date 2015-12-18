<?php
	require_once '../negocio/Inversion.class.php';
	$objInversion = new Inversion();
	$resultado=$objInversion->obtenerTipoSector();
	echo json_encode($resultado);
?>