<?php
	$codigo=$_POST["txtcodigoedit"];
	$cargo = $_POST["txtcargoedit"];
	require_once '../negocio/cargo.class.php';
	$objCargo = new Cargo();
	$objCargo->setCodigo($codigo);
	$objCargo->setDescripcion($cargo);
	$resultado=$objCargo->editar();
	echo json_encode($resultado);
?>