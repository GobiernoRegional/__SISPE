<?php
	$codigo=$_POST["txtcodigoedit"];
	$pland = $_POST["txtplandedit"];
        $titulo = $_POST["txttitulo"];
        $descripcion = $_POST["txtdescripcion"];
	require_once '../negocio/PlanDesarrollo.class.php';
	$objPlanD = new PlanDesarrollo();
	$objPlanD->setCodigo($codigo);
        $objPlanD->setTitulo($titulo);
	$objPlanD->setDescripcion($descripcion);
	$resultado=$objPlanD->editar();
	echo json_encode($resultado);
?>