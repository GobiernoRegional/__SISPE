<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ObjetivoNacional.class.php';
	$objObjNacional = new ObjNacional();
	$objObjNacional->setCodigo($codigo);
	$resultado=$objObjNacional->eliminar();
	echo json_encode($resultado);
?>