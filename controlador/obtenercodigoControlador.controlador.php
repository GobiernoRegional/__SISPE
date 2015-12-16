<?php
	require_once '../negocio/cargo.class.php';
	$objCargo = new Cargo();
	$resultado=$objCargo->ObtenerCodigo();
	echo json_encode($resultado);
?>