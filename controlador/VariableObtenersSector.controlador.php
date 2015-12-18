<?php
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$resultado=$objEje->obtenerSubcapitulos();
	echo json_encode($resultado);
?>