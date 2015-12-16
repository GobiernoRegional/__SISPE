<?php
	$codigo=$_POST["txtcodigo"];
	$area = $_POST["txtdependencia"];
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$objArea->setCodigo($codigo);
	$objArea->setDescripcion($area);
        $objArea->setDependencia($dependencia);
	$resultado=$objDependencia->agregar();
	echo json_encode($resultado);
?>