<?php
	$titulo=$_POST["txtitulo"];
	$documento=$_POST["txtdescripcioneditor"];
	require_once '../negocio/prdc.class.php';
	$objPRDC = new Prdc();
	$objPRDC->setTitulo($titulo);
	$objPRDC->setDocumentoTexto($documento);
	$resultado=$objPRDC->registroManual();
	echo json_encode($resultado);
?>