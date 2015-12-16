<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$resultado=$objDependencia->leerDatos($codigo);
	echo json_encode($resultado);
?>