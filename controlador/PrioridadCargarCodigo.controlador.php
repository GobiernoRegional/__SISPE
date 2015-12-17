<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Prioridad.class.php';
	$objPrioridad = new Prioridad();
	$resultado=$objPrioridad->leerDatos($codigo);
	echo json_encode($resultado);
?>