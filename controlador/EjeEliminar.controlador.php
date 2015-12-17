<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$objEje->setCodigo($codigo);
	$resultado=$objEje->eliminar();
	echo json_encode($resultado);
?>