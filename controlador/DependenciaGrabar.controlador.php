<?php
	$dependencia = $_POST["txtnombre"];
	$telefono = $_POST["txttelefono"];
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setDescripcion($dependencia);
	$objDependencia->setTelefono($telefono);
	$resultado=$objDependencia->agregar();
	echo json_encode($resultado);
?>