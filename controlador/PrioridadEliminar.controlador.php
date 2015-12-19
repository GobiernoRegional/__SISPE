<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Prioridad.class.php';
    $objPrioridad = new Prioridad();
	$objPrioridad->setCodigo($codigo);
	$resultado=$objPrioridad->eliminar();
	echo json_encode($resultado);
?>