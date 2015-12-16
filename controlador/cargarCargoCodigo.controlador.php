<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/cargo.class.php';
	$objCargo = new Cargo();
	$resultado=$objCargo->leerDatos($codigo);
	echo json_encode($resultado);
?>