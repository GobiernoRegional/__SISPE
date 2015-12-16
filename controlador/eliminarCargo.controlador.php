<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/cargo.class.php';
	$objCargo = new Cargo();
	$objCargo->setCodigo($codigo);
	$resultado=$objCargo->eliminar();
	echo json_encode($resultado);
?>