<?php
	$area=$_POST["txtnombre"];
	$dependencia = $_POST["txtdependencia"];
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$objArea->setDescripcion($area);
    $objArea->setDependencia($dependencia);
	$resultado=$objArea->agregar();
	echo json_encode($resultado);
?>