<?php
	$codigo=$_POST["txtcodigoedit"];
	$objetivo = $_POST["txtnombreedit"];
        $eje = $_POST["txtejeedit"];
	require_once '../negocio/objetivoEstrategico.class.php';
	$objObjetivo = new Objetivo();
	$objObjetivo->setCodigo($codigo);
	$objObjetivo->setNombre($objetivo);
        $objObjetivo->setObjetivo($eje);
	$resultado=$objObjetivo->editar();
	echo json_encode($resultado);
?>