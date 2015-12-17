<?php
	$pland = $_POST["txtpland"];
        $descripcion= $_POST["txtdescripcion"];
	require_once '../negocio/PlanDesarrollo.class.php';
	$objPlanD = new PlanDesarrollo();
	$objPlanD->setTitulo($pland);
        $objPlanD->setDescripcion($descripcion);
	$resultado=$objPlanD->agregar();
	echo json_encode($resultado);
?>