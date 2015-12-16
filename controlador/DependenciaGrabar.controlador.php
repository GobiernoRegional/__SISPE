<?php
	$codigo=$_POST["txtcodigo"];
	$dependencia = $_POST["txtdependencia"];
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setCodigo($codigo);
	$objDependencia->setDescripcion($dependencia);
	$resultado=$objDependencia->agregar();
	echo json_encode($resultado);
?>