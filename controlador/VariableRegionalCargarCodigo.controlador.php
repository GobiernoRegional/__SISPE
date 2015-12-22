<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
	$resultado=$objVariableRegional->leerDatos($codigo);
	echo json_encode($resultado);
?>