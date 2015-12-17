<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/EjeEstrategico.class.php';
	$objEje = new EjeEstrategico();
	$resultado=$objEje->leerDatos($codigo);
	echo json_encode($resultado);
?>