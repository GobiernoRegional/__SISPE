<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Accion.class.php';
	$objAccion = new Accion();
	$resultado=$objAccion->leerDatos($codigo);
	echo json_encode($resultado);
?>