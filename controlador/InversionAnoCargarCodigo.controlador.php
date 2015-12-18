<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/InversionAno.class.php';
	$objInversionAno = new InversionAno();
	$resultado=$objInversionAno->leerDatos($codigo);
	echo json_encode($resultado);
?>