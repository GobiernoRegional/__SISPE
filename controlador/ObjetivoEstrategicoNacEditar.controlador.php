<?php
	$codigo=$_POST["txtcodigoedit"];
	$objetivo = $_POST["txtnombreedit"];
        $eje = $_POST["txtejeedit"];
	require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
	$objObjetivoEspNac = new ObjetivoEspNac();
	$objObjetivoEspNac->setCodigo($codigo);
	$objObjetivoEspNac->setNombre($objetivo);
        $objObjetivoEspNac->setEje($eje);
	$resultado=$objObjetivoEspNac->editar();
	echo json_encode($resultado);
?>