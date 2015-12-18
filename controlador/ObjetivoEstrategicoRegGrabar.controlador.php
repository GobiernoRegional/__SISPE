<?php
	$objetivo=$_POST["txtnombre"];
	$eje = $_POST["txteje"];
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setNombre($eje);
        $objObjetivo->setEje($eje);
	$resultado=$objObjetivo->agregar();
	echo json_encode($resultado);
?>