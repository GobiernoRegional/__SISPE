<?php
	$codigo=$_POST["txtcodigoedit"];
	$objetivo = $_POST["txtnombreedit"];
        $eje = $_POST["txtejeedit"];
	require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setCodigo($codigo);
	$objObjetivo->setNombre($objetivo);
        $objObjetivo->setEje($eje);
	$resultado=$objObjetivo->editar();
	echo json_encode($resultado);
?>