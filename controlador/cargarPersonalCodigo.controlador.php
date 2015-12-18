<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/personal.class.php';
	$objPersonal = new Personal();
	$resultado=$objPersonal->leerDatos($codigo);
	echo json_encode($resultado);
?>