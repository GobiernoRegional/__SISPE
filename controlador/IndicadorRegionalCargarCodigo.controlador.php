<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/IndicadorRegional.class.php';
	$objIndicadorRegional = new IndicadorRegional();
	$resultado=$objIndicadorRegional->leerDatos($codigo);
	echo json_encode($resultado);
?>