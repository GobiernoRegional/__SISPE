<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/PlanDesarrollo.class.php';
	$objPlanD = new PlanDesarrollo();
	$objPlanD->setCodigo($codigo);
	$resultado=$objPlanD->eliminar();
	echo json_encode($resultado);
?>