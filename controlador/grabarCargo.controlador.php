<?php
	$codigo=$_POST["txtcodigo"];
	$cargo = $_POST["txtcargo"];
	require_once '../negocio/cargo.class.php';
	$objCargo = new Cargo();
	$objCargo->setCodigo($codigo);
	$objCargo->setDescripcion($cargo);
	$resultado=$objCargo->agregar();
	echo json_encode($resultado);
?>