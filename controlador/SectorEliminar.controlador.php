<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$objArea->setCodigo($codigo);
	$resultado=$objArea->eliminar();
	echo json_encode($resultado);
?>