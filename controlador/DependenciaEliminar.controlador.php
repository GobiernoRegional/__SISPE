<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setCodigo($codigo);
	$resultado=$objDependencia->eliminar();
	echo json_encode($resultado);
?>