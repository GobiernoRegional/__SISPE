<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ObjetivoNacional.class.php';
	$objObjNacional = new ObjNacional();
	$resultado=$objObjNacional->leerDatos($codigo);
	echo json_encode($resultado);
?>