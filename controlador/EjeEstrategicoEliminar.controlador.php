<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/EjeEstrategico.class.php';
	$objEje = new EjeEstrategico();
	$objEje->setCodigo($codigo);
	$resultado=$objEje->eliminar();
	echo json_encode($resultado);
?>