<?php
	$codigo=$_POST["txtcodigoedit"];
	$area = $_POST["txtareaedit"];
        
	require_once '../negocio/area.class.php';
	$objArea = new Area();
	$objArea->setCodigo($codigo);
	$objArea->setDescripcion($area);
        $objArea->setDependencia($area);
	$resultado=$objArea->editar();
	echo json_encode($resultado);
?>