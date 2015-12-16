<?php
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$resultado=$objDependencia->ObtenerCodigo();
	echo json_encode($resultado);
?>