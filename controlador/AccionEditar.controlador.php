<?php
	$codigo=$_POST["txtcodigoedit"];
	$area = $_POST["txtnombreedit"];
    $dependencia = $_POST["txtdependenciaedit"];
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$objArea->setCodigo($codigo);
	$objArea->setDescripcion($area);
    $objArea->setDependencia($dependencia);
	$resultado=$objArea->editar();
	echo json_encode($resultado);
?>