<?php
	$objetivo=$_POST["txtobjetivo"];
	$eje = $_POST["txteje"];
	$descripcion=$_POST["txtdescripcion"];
	require_once '../negocio/objetivoEstrategico.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setNombre($objetivo);
    $objObjetivo->setEje($eje);
    $objObjetivo->setDescripcion($descripcion);
	$resultado=$objObjetivo->agregar();
	echo json_encode($resultado);
?>