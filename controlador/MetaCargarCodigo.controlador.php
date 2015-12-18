<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Meta.class.php';
	$objMeta = new Meta();
	$resultado=$objMeta->leerDatos($codigo);
	echo json_encode($resultado);
?>
