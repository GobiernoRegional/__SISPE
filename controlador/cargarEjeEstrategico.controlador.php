<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$resultado=$objEje->leerDatos($codigo);
	echo json_encode($resultado);
?>