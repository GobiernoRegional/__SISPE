<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/PlanDesarrollo.class.php';
	$objPlanD = new PlanDesarrollo();
	$resultado=$objPlanD->leerDatos($codigo);
	echo json_encode($resultado);
?>