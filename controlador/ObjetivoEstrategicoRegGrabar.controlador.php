<?php
	$objetivo=$_POST["txtobjetivo"];
	$eje = $_POST["txteje"];
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setNombre($objetivo);
    $objObjetivo->setEje($eje);
	$resultado=$objObjetivo->agregar();
	echo json_encode($resultado);
?>