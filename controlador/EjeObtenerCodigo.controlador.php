<?php
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$resultado=$objEje->ObtenerCodigo();
	echo json_encode($resultado);
?>