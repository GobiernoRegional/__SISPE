<?php
	$objetivo=$_POST["txtobjetivo"];
	$eje = $_POST["txteje"];
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$objObjetivoEspNac->setNombre($objetivo);
    $objObjetivoEspNac->setEje($eje);
	$resultado=$objObjetivoEspNac->agregar();
	echo json_encode($resultado);
?>