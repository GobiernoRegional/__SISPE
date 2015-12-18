<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Variable.class.php';
	$objVariable = new Variable();
	$resultado=$objVariable->leerDatos($codigo);
	echo json_encode($resultado);
?>