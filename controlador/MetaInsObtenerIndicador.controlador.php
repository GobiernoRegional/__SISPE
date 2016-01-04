<?php
	require_once '../negocio/MetaInstitucional.class.php';
	$objMetaIns = new MetaInstitucional();
	$resultado=$objMetaIns->obtenerIndicador();
	echo json_encode($resultado);
?>