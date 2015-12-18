<?php
	$objetivo=$_POST["txtnombre"];
	$eje = $_POST["txteje"];
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$objObjetivoEspNac->setNombre($eje);
        $objObjetivoEspNac->setEje($eje);
	$resultado=$objObjetivoEspNac->agregar();
	echo json_encode($resultado);
?>