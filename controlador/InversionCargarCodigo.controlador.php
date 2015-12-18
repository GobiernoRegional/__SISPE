<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Inversion.class.php';
	$objInversion = new Inversion();
	$resultado=$objInversion->leerDatos($codigo);
	echo json_encode($resultado);
?>