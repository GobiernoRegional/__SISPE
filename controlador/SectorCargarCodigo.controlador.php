<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$resultado=$objTipoSector->leerDatos($codigo);
	echo json_encode($resultado);
?>