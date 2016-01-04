<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/IndicadorInstitucional.php';
	$objIndicadorInst = new IndicadorInstitucional();
	$resultado=$objIndicadorInst->leerDatos($codigo);
	echo json_encode($resultado);
?>