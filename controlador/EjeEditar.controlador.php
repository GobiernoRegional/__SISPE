<?php
	$codigo=$_POST["txtcodigoedit"];
	$eje = $_POST["txtnombreedit"];
        $subcapitulo = $_POST["txtsubcapituloedit"];
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$objEje->setCodigo($codigo);
	$objEje->setNombre($eje);
        $objEje->setSubcapitulo($subcapitulo);
	$resultado=$objEje->editar();
	echo json_encode($resultado);
?>