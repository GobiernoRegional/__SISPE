<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/AccionInstitucional.php';
	$objAccionIns = new AccionInstitucional();
	$resultado=$objAccionIns->leerDatos($codigo);
	echo json_encode($resultado);
?>