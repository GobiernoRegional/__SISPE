<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$resultado=$objArea->leerDatos($codigo);
	echo json_encode($resultado);
?>